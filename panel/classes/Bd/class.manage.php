<?php 
	class Manage {
		protected $db = null;
		protected $table;
		protected $key;
		
		/**
		 * Obtiene todos los registros de la tabla admin 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		 function get($filters, $fields = '*', $order=null, $condition=null) {
			$ro = new Response();
			$ro->resultado = true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			if (!isset($order))
				if (isset($condition))
					$this->db->query("SELECT ".$fields." FROM ".$this->table." ".$filtros." ".$condition." ;");
				else
					$this->db->query("SELECT ".$fields." FROM ".$this->table." ".$filtros." ;");
			else
				if (isset($condition))
					$this->db->query("SELECT ".$fields." FROM ".$this->table." ".$filtros." order by ".$order." ".$condition." ;");
				else
					$this->db->query("SELECT ".$fields." FROM ".$this->table." ".$filtros." order by ".$order." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$rows = $this->db->resultset();
			
			//proceso los datos
			if(is_array($rows) && sizeof($rows)>0) {
				$ro->datos = $rows;
			}  else {
				$ro->resultado = false;
				$ro->mensaje   = "Error: Se ha producido un error al obtener los registros";
			}
			
			return $ro;
		}
		
		/**
		 * Realiza un insert / update automáticamente
		 * en función de si le pasamos el id o no
		 * @param array $datos array completo con todos los campos
		 * que interactuan en la query
		 * del tipo [':campo'] => 'valor'
		 */
		function stor($datos) {  // recibe un array asociativo
			$ro = new Response();
			$ro->resultado = true;
			if (sizeof($datos) != null) { 
				if ($result = $this->db->stor($datos, $this->table)) {
					$ro->id = $result;
				} else {
					$ro->resultado = false;
					$ro->mensaje   = "Error al Insertar/Modificar.";
				}
			} else {
					$ro->resultado = false;
					$ro->mensaje   = "Error al Insertar/Modificar. Se ha pasado un array nulo.";
			}
			return $ro;	
		}
		
		/**
		 * Obtiene el total de los registros buscados de la tabla definida		 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 */
		function get_total($filters) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM ".$this->table." ".$filtros." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$this->db->resultset();
			
			//obtengo los resultados
			$ro->datos 		= array();
			$ro->datos['total'] 	= $this->db->rowCount();
			return $ro;
		}
		
		/**
		 * Borra un registro de la tabla definida, comprobando previamente su existencia
		 * @param array $id id del registro a borrar
		 */
		function delete($id){
			$ro = new Response();
			$ro->resultado = true;
 
			//busco el registro en la tabla
			$this->db->query("select * FROM ".$this->table." where ".$this->key."= :".$this->key." ;");
			$this->db->bind(":".$this->key, $id);
			$arr_res = $this->db->single();
			
			//si lo encuentro
			if(sizeof($arr_res) > 0) {
				//preparo la query
				$this->db->query("delete from ".$this->table." where ".$this->key."= :".$this->key." ;");
				$this->db->bind(":".$this->key, $id);
				//lo borro
				$this->db->execute() ;
				//devuelvo el id del registro borrado
				$ro->id = $id;
			} else {//si no lo encuento, peto
				$ro->resultado = false;
				$ro->id        = $id;
				$ro->mensaje = "Error: se ha producido un error al borrar el registro ".$id." de la tabla ".$this->table;
			}
			
			return $ro;
		}
		
	
	} // class
?>		