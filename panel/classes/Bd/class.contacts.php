<?php 
	class Contacts {
	
		var $db = null;
		function Contacts($db) {
			$this->db = $db;
		}
		
		/**
		 * Obtiene todos los registros de la tabla contacts 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		 function get_contacts($filters, $order="id_contact asc") {
			$ro = new Response();
			$ro->resultado = true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM contacts ".$filtros." order by ".$order." ;");
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
		 * en función de si le pasamos el id_contact o no
		 * @param array $datos array completo con todos los campos
		 * que interactuan en la query
		 * del tipo [':campo'] => 'valor'
		 */
		function stor_contacts($datos) {  // recibe un array asociativo
			$ro = new Response();
			$ro->resultado = true;
			if (sizeof($datos) != null) { 
				if ($result = $this->db->stor($datos, "contacts")) {
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
		 * Realiza un insert / update a pelo sin función stor en la tabla contacts
		 * en función de si le pasamos el id_contact o no  hace update o no.
		 * @param array $datos array completo con todos los campos
		 * que tiene la tabla para insertar/actualizar 
		 * del tipo [':campo'] => 'valor'
		 */
		function update_contacts($datos) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			if ($datos[':id_contact'] != null) {
				//preparo la query
				$this->db->query("update contacts set id_contact = :id_contact, date = :date, type = :type, lang = :lang, name = :name, email = :email, message = :message, telf = :telf, deliver = :deliver  where id_contact = :id_contact ;");
				$this->db->prebind($datos);
				
				//la ejecuto
				if ($this->db->execute() == false) {//si va mal
					$ro->resultado = false;
					$ro->mensaje   = "No se ha podido actualizar la tabla contacts.";
				} else {//si va bien
					$ro->id = $datos[':id_contact'];//devuelvo el id actualizado
				}
				
			} else {
				//preparo la query
				$this->db->query("insert into contacts (id_contact, date, type, lang, name, email, message, telf, deliver) values (:id_contact, :date, :type, :lang, :name, :email, :message, :telf, :deliver) ;");
				$this->db->prebind($datos);
				//la ejecuto
				if ($this->db->execute() == false) {//va mal
					$ro->resultado = false;
					$ro->mensaje   = "Error: No se ha podido insertar la tabla contacts.";
				} else {//si va bien
					$ro->id = $this->db->lastInsertId();//obtengo el ultimo id insertado
				}
			}
			return $ro;
		}
		
		/**
		 * Obtiene el total de los registros buscados de la tabla contacts		 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 */
		function get_total_contacts($filters) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM contacts ".$filtros." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$this->db->resultset();
			
			//obtengo los resultados
			$ro->datos 		= array();
			$ro->datos['total'] 	= $this->db->rowCount();
			return $ro;
		}
		
		/**
		 * Borra un registro de la tabla contacts, comprobando previamente su existencia
		 * @param array $id_contact id del registro a borrar
		 */
		function delete_contacts($id_contact){
			$ro = new Response();
			$ro->resultado = true;
 
			//busco el registro en la tabla
			$this->db->query("select * FROM contacts where id_contact= :id_contact ;");
			$this->db->bind(":id_contact", $id_contact);
			$arr_res = $this->db->single();
			
			//si lo encuentro
			if(sizeof($arr_res) > 0) {
				//preparo la query
				$this->db->query("delete from contacts where id_contact= :id_contact ;");
				$this->db->bind(":id_contact", $id_contact);
				//lo borro
				$this->db->execute() ;
				//devuelvo el id del registro borrado
				$ro->id = $id_contact;
			} else {//si no lo encuento, peto
				$ro->resultado = false;
				$ro->id        = $id_contact;
				$ro->mensaje = "Error: se ha producido un error al borrar el registro ".$id_contact." de la tabla contacts";
			}
			
			return $ro;
		}
		
	
	} // class
		
?>		