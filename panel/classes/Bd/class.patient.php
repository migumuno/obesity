<?php
class Patient extends Manage {
	
	
	function Patient($db) {
		$this->table = 'patient';
		$this->key = 'id_patient';
		$this->db = $db;
	}
	
	/**
	 * 
	 * Consulta la info de un paciente en la base de datos que se corresponda con el identificador
	 * @param int $type dependiendo del tipo, obtendra unos campos u otros.
	 * @param int $id id del paciente
	 */
	public function getPatient ($type, $id) {
		switch ($type) {
			case "info":
				$this->table = 'patients_info';
				break;
			case "user":
				$this->table = 'patients_user';
		}
		$filters = array();
		add_filter($filters, 'id_patient', $id);
		return $this->get($filters);
	}
	
	/**
	 * Busca un paciente en la base de datos que se corresponda con el usuario indicado
	 * @param string $search usuario del paciente que se quiere buscar.
	 */
	public function searchPatient ($search) {
		$this->table = 'patient';
		$filters = array();
		add_filter($filters, 'usuario', $search);
		add_filter($filters, 'estado', DESBLOQUEADO);
		return $this->get($filters);
	}
	
	public function checkKey ($user, $key) {
		$this->table = 'patient';
		$filters = array();
		add_filter($filters, 'usuario', $user);
		add_filter($filters, 'keyphrase', $key);
		return $this->get($filters);
	}
	
	/**
	 * 
	 * Devuelve una lista con todos los pacientes que estén activos.
	 */
	public function getPatientsList () {
		$this->table = 'patient';
		$filters = array();
		add_filter($filters, 'estado', 0);
		return $this->get($filters, 'nombre, apellidos, id_patient');
	}
	
	/**
	 * Se encarga de bloquear un paciente para que no pueda acceder al panel o desbloquearlo
	 * @param int $id id del paciente a bloquear o desbloquear
	 * @param int $state indica si se bloquea o se desbloquea.
	 */
	public function statePatient ($id, $state) {
		$this->table = 'patient';
		$datos = array();
		$datos[':id_patient'] = $id;
		$datos[':estado'] = $state;
		$this->stor($datos);
	}
	
	/**
	 * Actualiza los datos del paciente
	 * @param array $datos datos a actualizar
	 */
	public function updatePatient ($id, $datos) {
		$this->table = 'patient';
		$aux[':id_patient'] = $id;
		foreach ($datos as $k=>$v) {
			$aux[':'.$k] = $v;
		}
		return $this->stor($aux);
	}
	
	/**
	 * Cambia la contraseña
	 * @param int $id identificador del admin
	 * @param string $pass
	 */
	public function changePass ($id, $pass, $pass_old) {
		$this->table = 'patient';
		if ($pass_old == $pass) {
			$datos = array();
			$datos[':id_patient'] = $id;
			$datos[':pass'] = encrypt($pass);
			if ($this->stor($datos))
				return true;
			else
				return false;
		} else 
			return false;
	}
	
	public function insertPatient ($datos) {
		$this->table = 'patient';
		foreach ($datos as $k => $v) {
			$aux[':'.$k] = $v;
		}
		$result = $this->stor($aux);
		return $result;
	}
}
?>