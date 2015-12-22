<?php
class Calendar extends Manage {
	
	
	function Calendar($db) {
		$this->table = 'calendar';
		$this->key = 'id_calendar';
		$this->db = $db;
	}
	
	/**
	 * Obtiene todas las citas o recordatorios del paciente
	 * @param int $id identificador del paciente
	 * @param string $tipo indica el tipo del evento
	 */
	public function getFromPatient($tipo, $id, $filtros = null) {
		switch ($tipo) {
			case "cita":
				$this->table = 'citas';
				break;
			case "recordatorio":
				$this->table = 'recordatorios';
				break;
		}
		$filters = array();
		add_filter($filters, 'id_patient', $id);
		if (isset($filtros)) {
			foreach ($filtros as $k=>$v) {
				add_filter($filters, $k, $v);
			}
		}
		$result = $this->get($filters);
		
		$this->table = 'calendar';
		return $result;
	}
	
	/**
	 * Obtiene todas las citas o recordatorios del paciente
	 * @param int $id identificador del paciente
	 * @param string $tipo indica el tipo del evento
	 */
	public function getOneEvent($tipo, $id, $filtros = null) {
		switch ($tipo) {
			case "cita":
				$this->table = 'citas';
				break;
			case "recordatorio":
				$this->table = 'recordatorios';
				break;
		}
		$filters = array();
		add_filter($filters, 'id_calendar', $id);
		if (isset($filtros)) {
			foreach ($filtros as $k=>$v) {
				add_filter($filters, $k, $v);
			}
		}
		$result = $this->get($filters);
		
		$this->table = 'calendar';
		return $result;
	}
	
	
	
	/**
	 * Obtiene todas las citas y recordatorios del paciente
	 * @param int $id identificador del paciente
	 * @param string $tipo indica el tipo del evento
	 */
	public function getFromPatientEvents($id, $filtros = null) {
		$this->table = 'calendar';
		$filters = array();
		add_filter($filters, 'id_patient', $id);
		if (isset($filtros)) {
			foreach ($filtros as $k=>$v) {
				add_filter($filters, $k, $v);
			}
		}
		return $this->get($filters);
	}
	
	/**
	 * Obtiene todas las citas o recordatorios de todos los pacientes
	 * @param string $tipo indica el tipo del evento
	 */
	public function getAll ($tipo) {
		switch ($tiipo) {
			case "cita":
				$this->table = 'citas';
				break;
			case "recordatorio":
				$this->table = 'recordatorios';
				break;
		}
		$filters = array();
		return $this->get($filters);
	}
	
	/**
	 * Obtiene todas las citas o recordatorios de todos los pacientes
	 * @param string $tipo indica el tipo del evento
	 */
	public function getAllEvents () {
		$this->table = 'calendar';
		$filters = array();
		return $this->get($filters);
	}
	
	/**
	 * Crea una nueva cita o recordatorio
	 * @param array $data datos de la cita
	 * @param string $tipo indica el tipo del evento
	 */
	public function insertInCalendar ($tipo, $data) {
		$this->table = 'calendar';
		foreach ($data as $k => $v) {
			$aux[':'.$k] = $v;
		}
		switch ($tipo) {
			case "cita":
				$aux[':tipo'] = 0;
				break;
			case "recordatorio":
				$aux[':tipo'] = 1;
				break;
		}
		$result = $this->stor($aux);
		return $result;
	}
	
	/**
	 * Actualiza una evento
	 * @param array $data datos de la cita a actualizar
	 * @param int $id identificador de la cita
	 */
	public function updateCalendar ($data, $id) {
		$this->table = 'calendar';
		foreach ($data as $k => $v) {
			$aux[':'.$k] = $v;
		}
		$aux[':'.$this->key] = $id;
		$result = $this->stor($aux);
		return $result;
	}
}