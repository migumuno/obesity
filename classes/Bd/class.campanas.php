<?php 
	class Campanas {
	
		var $db = null;
		function Campanas($db) {
			$this->db = $db;
		}
		
		/**
		 * Obtiene todos los registros de la tabla campanas 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		 function get_campanas($filters, $order="id_campanas asc") {
			$ro = new Response();
			$ro->resultado = true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM campanas ".$filtros." order by ".$order." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$rows = $this->db->resultset();
			
			//proceso los datos
			if(is_array($rows)) {
				$ro->datos = $rows;
			}  else {
				$ro->resultado = false;
				$ro->mensaje   = "Error: Se ha producido un error al obtener los registros";
			}
			
			return $ro;
		}
		
		/**
		 * Realiza un insert / update automáticamente
		 * en función de si le pasamos el id_campanas o no
		 * @param array $datos array completo con todos los campos
		 * que interactuan en la query
		 * del tipo [':campo'] => 'valor'
		 */
		function stor_campanas($datos) {  // recibe un array asociativo
			$ro = new Response();
			$ro->resultado = true;
			if (sizeof($datos) != null) { 
				if ($result = $this->db->stor($datos, "campanas")) {
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
		 * Realiza un insert / update a pelo sin función stor en la tabla campanas
		 * en función de si le pasamos el id_campanas o no  hace update o no.
		 * @param array $datos array completo con todos los campos
		 * que tiene la tabla para insertar/actualizar 
		 * del tipo [':campo'] => 'valor'
		 */
		function update_campanas($datos) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			if ($datos[':id_campanas'] != null) {
				//preparo la query
				$this->db->query("update campanas set id_campanas = :id_campanas, date = :date, type = :type, lang = :lang, name = :name, email = :email, message = :message, telf = :telf, deliver = :deliver  where id_campanas = :id_campanas ;");
				$this->db->prebind($datos);
				
				//la ejecuto
				if ($this->db->execute() == false) {//si va mal
					$ro->resultado = false;
					$ro->mensaje   = "No se ha podido actualizar la tabla campanas.";
				} else {//si va bien
					$ro->id = $datos[':id_campanas'];//devuelvo el id actualizado
				}
				
			} else {
				//preparo la query
				$this->db->query("insert into campanas (id_campanas, date, type, lang, name, email, message, telf, deliver) values (:id_campanas, :date, :type, :lang, :name, :email, :message, :telf, :deliver) ;");
				$this->db->prebind($datos);
				//la ejecuto
				if ($this->db->execute() == false) {//va mal
					$ro->resultado = false;
					$ro->mensaje   = "Error: No se ha podido insertar la tabla campanas.";
				} else {//si va bien
					$ro->id = $this->db->lastInsertId();//obtengo el ultimo id insertado
				}
			}
			return $ro;
		}
		
		/**
		 * Obtiene el total de los registros buscados de la tabla campanas		 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 */
		function get_total_campanas($filters) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM campanas ".$filtros." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$this->db->resultset();
			
			//obtengo los resultados
			$ro->datos 		= array();
			$ro->datos['total'] 	= $this->db->rowCount();
			return $ro;
		}
		
		/**
		 * Borra un registro de la tabla campanas, comprobando previamente su existencia
		 * @param array $id_campanas id del registro a borrar
		 */
		function delete_campanas($id_campanas){
			$ro = new Response();
			$ro->resultado = true;
 
			//busco el registro en la tabla
			$this->db->query("select * FROM campanas where id_campanas= :id_campanas ;");
			$this->db->bind(":id_campanas", $id_campanas);
			$arr_res = $this->db->single();
			
			//si lo encuentro
			if(sizeof($arr_res) > 0) {
				//preparo la query
				$this->db->query("delete from campanas where id_campanas= :id_campanas ;");
				$this->db->bind(":id_campanas", $id_campanas);
				//lo borro
				$this->db->execute() ;
				//devuelvo el id del registro borrado
				$ro->id = $id_campanas;
			} else {//si no lo encuento, peto
				$ro->resultado = false;
				$ro->id        = $id_campanas;
				$ro->mensaje = "Error: se ha producido un error al borrar el registro ".$id_campanas." de la tabla campanas";
			}
			
			return $ro;
		}
		
	
	} // class
		
?>		