<?php 
	class Wp_posts {
	
		var $db = null;
		function Wp_posts($db) {
			$this->db = $db;
		}
		
	/**
		 * Obtiene todos los registros de la tabla wp_posts 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		 function get_last_wp_posts($lang) {
			$ro = new Response();
			$ro->resultado = true;
			switch ($lang) {
				case 'es':
					$table = wp_2_posts;
					$table2 = wp_2_postmeta;
					break;
				case 'en':
					$table = wp_3_posts;
					$table2 = wp_3_postmeta;
					break;
				case 'de':
					$table = wp_4_posts;
					$table2 = wp_4_postmeta;
					break;
				default:
					$table = wp_posts;
			}
			
			//preparo la query
			$this->db->query("
				SELECT wp1.post_title AS titulo, wp1.ID, wp1.post_date AS fecha, wp1.post_content AS contenido, wp2.guid AS img, wp1.guid AS link
				FROM ".$table." wp1
				    LEFT JOIN ".$table2." pm ON (wp1.ID = pm.post_id)
					LEFT JOIN ".$table." wp2 ON (pm.meta_value = wp2.ID)
				WHERE wp1.post_type = 'post' 
					AND wp1.post_status = 'publish'
					AND pm.meta_key = '_thumbnail_id'
				ORDER BY wp1.post_date DESC
				LIMIT 3;
			");
			
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
		 * Obtiene todos los registros de la tabla wp_posts 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 * @param string $order
		 */
		 function get_wp_posts($filters, $order="ID asc") {
			$ro = new Response();
			$ro->resultado = true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM wp_posts ".$filtros." order by ".$order." ;");
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
		 * en función de si le pasamos el ID o no
		 * @param array $datos array completo con todos los campos
		 * que interactuan en la query
		 * del tipo [':campo'] => 'valor'
		 */
		function stor_wp_posts($datos) {  // recibe un array asociativo
			$ro = new Response();
			$ro->resultado = true;
			if (sizeof($datos) != null) { 
				if ($result = $this->db->stor($datos, "wp_posts")) {
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
		 * Realiza un insert / update a pelo sin función stor en la tabla wp_posts
		 * en función de si le pasamos el ID o no  hace update o no.
		 * @param array $datos array completo con todos los campos
		 * que tiene la tabla para insertar/actualizar 
		 * del tipo [':campo'] => 'valor'
		 */
		function update_wp_posts($datos) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			if ($datos[':ID'] != null) {
				//preparo la query
				$this->db->query("update wp_posts set id = :id, post_author = :post_author, post_date = :post_date, post_date_gmt = :post_date_gmt, post_content = :post_content, post_title = :post_title, post_excerpt = :post_excerpt, post_status = :post_status, comment_status = :comment_status, ping_status = :ping_status, post_password = :post_password, post_name = :post_name, to_ping = :to_ping, pinged = :pinged, post_modified = :post_modified, post_modified_gmt = :post_modified_gmt, post_content_filtered = :post_content_filtered, post_parent = :post_parent, guid = :guid, menu_order = :menu_order, post_type = :post_type, post_mime_type = :post_mime_type, comment_count = :comment_count  where ID = :ID ;");
				$this->db->prebind($datos);
				
				//la ejecuto
				if ($this->db->execute() == false) {//si va mal
					$ro->resultado = false;
					$ro->mensaje   = "No se ha podido actualizar la tabla wp_posts.";
				} else {//si va bien
					$ro->id = $datos[':ID'];//devuelvo el id actualizado
				}
				
			} else {
				//preparo la query
				$this->db->query("insert into wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) values (:ID, :post_author, :post_date, :post_date_gmt, :post_content, :post_title, :post_excerpt, :post_status, :comment_status, :ping_status, :post_password, :post_name, :to_ping, :pinged, :post_modified, :post_modified_gmt, :post_content_filtered, :post_parent, :guid, :menu_order, :post_type, :post_mime_type, :comment_count) ;");
				$this->db->prebind($datos);
				//la ejecuto
				if ($this->db->execute() == false) {//va mal
					$ro->resultado = false;
					$ro->mensaje   = "Error: No se ha podido insertar la tabla wp_posts.";
				} else {//si va bien
					$ro->id = $this->db->lastInsertId();//obtengo el ultimo id insertado
				}
			}
			return $ro;
		}
		
		/**
		 * Obtiene el total de los registros buscados de la tabla wp_posts		 
		 * que cumplan los requisitos pasado por los filtros
		 * @param array $filters se recibe un array con 2 posiciones
		 * en la primera posición tenemos las keys generadas con anade_filtrado
		 * en la segunda posición tenemos los values en un array 
		 * del tipo [':campo'] => 'valor'
		 */
		function get_total_wp_posts($filters) {
			$ro 			= new Response();
			$ro->resultado 	= true;
			
			//preparo la query
			$filtros = prepare_filters($filters['keys']);
			$this->db->query("SELECT * FROM wp_posts ".$filtros." ;");
			$this->db->prebind($filters['values']);
			
			//la ejecuto
			$this->db->resultset();
			
			//obtengo los resultados
			$ro->datos 		= array();
			$ro->datos['total'] 	= $this->db->rowCount();
			return $ro;
		}
		
		/**
		 * Borra un registro de la tabla wp_posts, comprobando previamente su existencia
		 * @param array $ID id del registro a borrar
		 */
		function delete_wp_posts($ID){
			$ro = new Response();
			$ro->resultado = true;
 
			//busco el registro en la tabla
			$this->db->query("select * FROM wp_posts where ID= :ID ;");
			$this->db->bind(":ID", $ID);
			$arr_res = $this->db->single();
			
			//si lo encuentro
			if(sizeof($arr_res) > 0) {
				//preparo la query
				$this->db->query("delete from wp_posts where ID= :ID ;");
				$this->db->bind(":ID", $ID);
				//lo borro
				$this->db->execute() ;
				//devuelvo el id del registro borrado
				$ro->id = $ID;
			} else {//si no lo encuento, peto
				$ro->resultado = false;
				$ro->id        = $ID;
				$ro->mensaje = "Error: se ha producido un error al borrar el registro ".$ID." de la tabla wp_posts";
			}
			
			return $ro;
		}
		
	
	} // class
		
?>