<?php
class Messages extends Manage {
	
	
	function Messages($db) {
		$this->table = 'message';
		$this->key = 'id_message';
		$this->db = $db;
	}
	
	/**
	 * 
	 * Fucnión que se encarga de realizar el envío de mensajes. Guarda el mensaje en las dos tablas de la base de datos.
	 * @param int $patient id del paciente.
	 * @param int $admin id del admin.
	 * @param array $mensaje array asociativo con el contenido del mensaje.
	 * @param const int $emisor define el emisor del envío, paciente = 0, admin = 1.
	 */
	public function sendMessage ($emisor, $patient, $admin, $mensaje, $asunto) {
		//Inserto los datos del mensaje
		$this->table = 'message';
		$this->key = 'id_message';
		$datos = array();
		$datos[':asunto'] = $asunto;
		$datos[':texto'] = $mensaje;
		$result = $this->stor($datos);
		//Inserto la relación entre emisor y receptor
		if ($result->resultado) {
			$this->table = 'message_user';
			$this->key = 'id_message_user';
			unset($datos);
			$datos = array();
			$datos[':id_message'] = $this->db->lastInsertId();
			$datos[':tipo'] = $emisor;
			$datos[':id_patient'] = $patient;
			$datos[':id_admin'] = $admin;
			$result = $this->stor($datos);
		}
		return $result;
	}
	
	/**
	 * Devuelve todos los mensajes del usuario que ha iniciado sesión
	 * @param const int $type indica el tipo de usuario que es.
	 * @param int $id id del paciente o del administrador.
	 * @param array $filtros filtros sobre los mensajes obtenidos.
	 */
	public function getMessages ($type, $id, $filtros=null, $recived = null) {
		$filters = array();
		switch ($type) {
			case PATIENT:
				if (isset($recived))
					$this->table = 'enviados_paciente';
				else
					$this->table = 'recibidos_paciente';
				add_filter($filters, 'id_patient', $id);
				break;
			case ADMIN:
				if (isset($recived))
					$this->table = 'enviados_admin';
				else 
					$this->table = 'recibidos_admin';
				add_filter($filters, 'id_admin', $id);
				break;
		}
		if (isset($filtros)) {
			foreach ($filtros as $k => $v) {
				add_filter($filters, $k, $v);
			}
		}
		return $this->get($filters);
	}
	
	/**
	 * Devuelve todos los mensajes enviados por el usuario
	 * @param int $type
	 * @param int $id
	 * @param array $filtros
	 */
	public function getSendMessages ($type, $id, $filtros = null) {
		switch ($type) {
			case PATIENT:
				$this->table = 'enviados_paciente';
				add_filter($filters, 'id_patient', $id);
				break;
			case ADMIN:
				$this->table = 'enviados_admin';
				add_filter($filters, 'id_admin', $id);
				break;
		}
		add_filter($filters, 'eliminado', 0);
		if (isset($filtros)) {
			foreach ($filtros as $k => $v) {
				add_filter($filters, $k, $v);
			}
		}
		return $this->get($filters);
	}
	
	/**
	 * 
	 * Actualiza el estado de los mensajes
	 * @param string $action
	 * @param int $id
	 */
	public function setMsgState ($action, $id) {
		$this->table = 'message_user';
		$this->key = 'id_message_user';
		$datos = array();
		switch ($action) {
			case "read":
				$datos[':leido'] = 1;
				break;
			case "unread":
				$datos[':leido'] = 0;
				break;
			case "erase":
				$datos[':eliminado_receptor'] = 1;
				break;
			case "unerase":
				$datos[':eliminado_receptor'] = 0;
				break;
			case "erase_send":
				$datos[':eliminado_emisor'] = 1;
				break;
		}
		$datos[':'.$this->key] = (int)$id;
		$result = $this->stor($datos);
		return $result;
	}
	
	/**
	 * Cambia el estado de un mensaje a eliminado.
	 * @param int $id identificador del mensaje.
	 */
	public function deleteMessage ($id) {
		$this->table = 'message_user';
		$this->key = 'id_message_user';
		$datos = array();
		$datos[':id_message_user'] = $id;
		$this->stor($datos);
	}
}