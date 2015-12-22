<?php
class Admin extends Manage {
	
	
	function Admin($db) {
		$this->table = 'admin';
		$this->key = 'id_admin';
		$this->db = $db;
	}
	
	/**
	 * 
	 * Consulta la info de un admin en la base de datos que se corresponda con el identificador
	 * @param int $type dependiendo del tipo, obtendra unos campos u otros.
	 * @param int $id id del admin
	 */
	public function getAdmin ($type, $id) {
		switch ($type) {
			case "info":
				$this->table = 'admins_info';
				break;
			case "user":
				$this->table = 'admins_user';
		}
		$filters = array();
		add_filter($filters, 'id_admin', $id);
		return $this->get($filters);
	}
	
	/**
	 * Busca un administrador en la base de datos que se corresponda con el usuario indicado
	 * @param string $search usuario del admin que se quiere buscar.
	 */
	public function searchAdmin ($search) {
		$this->table = 'admin';
		$filters = array();
		add_filter($filters, 'usuario', $search);
		add_filter($filters, 'estado', DESBLOQUEADO);
		return $this->get($filters);
	}
	
	/**
	 * 
	 * Devuelve una lista con todos los administradores que estén activos.
	 */
	public function getAdminsList () {
		$this->table = 'admin';
		$filters = array();
		add_filter($filters, 'estado', 0);
		add_filter($filters, 'tipo', 0);
		return $this->get($filters, 'nombre, id_admin');
	}
	
	/**
	 * Se encarga de bloquear un adminisitrador para que no pueda acceder al panel o desbloquearlo
	 * @param int $id id del paciente a bloquear o desbloquear
	 * @param int $state indica si se bloquea o se desbloquea.
	 */
	public function stateAdmin ($id, $state) {
		$this->table = 'admin';
		$datos = array();
		$datos[':id_admin'] = $id;
		$datos[':estado'] = $state;
		$this->stor($datos);
	}
	
	/**
	 * Cambia la contraseña
	 * @param int $id identificador del admin
	 * @param string $pass
	 */
	public function changePass ($id, $pass, $pass_old) {
		$this->table = 'admin';
		if ($pass_old == $pass) {
			$datos = array();
			$datos[':id_admin'] = $id;
			$datos[':pass'] = encrypt($pass);
			if ($this->stor($datos))
				return true;
			else
				return false;
		} else 
			return false;
	}
	
	public function insertAdmin ($datos) {
		$this->table = admin;
		return $this->stor($datos);
	}
}
?>