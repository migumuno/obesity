<?php 
	class anno_academico {
		var $db = null;
		
		function anno_academico($db) {
			$this->db = $db;
		}
		
		/**
		 * Obtiene todos los registros de la tabla anno_academico
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posicion tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		function get_anno_academico($filters, $order="id_anno_academico asc") {
			$ro = new Response();
			$ro->resultado = true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM anno_academico ".$filtros." order by ".$order." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$rows = $this->db->resultset();
			
			//proceso los datos
			if(is_array($rows)) {
				$ro->datos = $rows;
			}  else {
				$ro->resultado = false;
				$ro->mensaje = "Error: Se ha producido un error al obtener los registros";
			}
			
			return $ro;
		}
		
		/**
		 * Realiza un insert / update automáticamente
		 * en función de si le pasamos el id_anno_academico o no
		 * @param array $datos array completo con TODOS los campos
		 * que interactuan en la query
		 * del tipo [':campo'] => 'valor'
		 */
		function stor_anno_academico($datos) {  // recibe un array asociativo
			$ro = new Response();
			$ro->resultado = true;
			if (sizeof($datos) != null) { 
				if ($result = $this->db->stor($datos, "usuario_perfil_actual")){
					$ro->id = $this->db->lastInsertId();
				} else {
					$ro->resultado = false;
					$ro->mensaje = "Error al Insertar/Modificar.";
				}
			} else {
					$ro->resultado = false;
					$ro->mensaje = "Error al Insertar/Modificar. Se ha pasado un array nulo.";
			}
			return $ro;	
		}
		
		/**
		 * Realiza un insert / update a pelo sin función stor en la tabla anno_academico
		 * en función de si le pasamos el id_anno_academico o no  hace update o no.
		 * @param array $datos array completo con TODOS los campos
		 * que tiene la tabla para insertar/actualizar 
		 * del tipo [':campo'] => 'valor'
		 */
		function update_anno_academico($datos) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			if ($datos[':id_anno_academico'] != null) {
				//preparo la query
				$this->db->query("update anno_academico set id_anno_academico = :id_anno_academico, nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, sexo = :sexo  where id_anno_academico = :id_anno_academico ;");
				$this->db->prebind($datos);
				
				//la ejecuto
				if ($this->db->execute() == false) {//si va mal
					$ro->resultado = false;
					$ro->mensaje   = "No se ha podido actualizar la tabla anno_academico.";
				} else {//si va bien
					$ro->id = $datos[':id_anno_academico'];//devuelvo el id actualizado
				}
				
			} else {
				//preparo la query
				$this->db->query("insert into anno_academico (id_anno_academico, nombre, apellido1, apellido2, sexo) values (:id_anno_academico, :nombre, :apellido1, :apellido2, :sexo) ;");
				$this->db->prebind($datos);
				//la ejecuto
				if ($this->db->execute() == false) {//va mal
					$ro->resultado = false;
					$ro->mensaje   = "Error: No se ha podido insertar la tabla anno_academico.";
				} else {//si va bien
					$ro->id = $this->db->lastInsertId();//obtengo el ultimo id insertado
				}
			}
			return $ro;
		}
		
		/**
		 * Obtiene el total de los registros buscados de la tabla anno_academico
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posicion tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 */
		function get_total_anno_academico($filters) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM anno_academico ".$filtros." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$this->db->resultset();
			
			//obtengo los resultados
			$ro->datos 			= array();
			
			$ro->datos['total'] 	= $this->db->rowCount();
			return $ro;
		}
		
		/**
		 * Borra un registro de la tabla anno_academico, comprobando previamente su existencia
		 * @param array $id_anno_academico id del registro a borrar
		 */
		function delete_anno_academico($id_anno_academico){
			$ro = new Response();
			$ro->resultado = true;
 
			//busco el registro en la tabla
			$this->db->query("select * FROM anno_academico where id_anno_academico= :id_anno_academico ;");
			$this->db->bind(":id_anno_academico", $id_anno_academico);
			$arr_res = $this->db->single();
			
			//si lo encuentro
			if(sizeof($arr_res) > 0) {
				//preparo la query
				$this->db->query("delete from anno_academico where id_anno_academico= :id_anno_academico ;");
				$this->db->bind(":id_anno_academico", $id_anno_academico);
				//lo borro
				$this->db->execute() ;
				//devuelvo el id del registro borrado
				$ro->id = $id_anno_academico;
			} else {//si no lo encuento, peto
				$ro->resultado = false;
				$ro->id        = $id_anno_academico;
				$ro->mensaje = "Error: se ha producido un error al borrar el registro ".$id_anno_academico." de la tabla anno_academico";
			}
			
			return $ro;
		}
	} // class
		
?>