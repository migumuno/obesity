<?php
class Notes extends Manage {
	
	
	function Notes($db) {
		$this->table = 'note';
		$this->key = 'id_note';
		$this->db = $db;
	}
	
	/**
	 * Crea una nueva nota
	 * @param array $data datos de la nota
	 */
	public function insertNote ($data) {
		foreach ($data as $k => $v) {
			$aux[':'.$k] = $v;
		}
		$result = $this->stor($aux);
		return $result;
	}
	
	/**
	 * Actualiza una nota
	 * @param array $data datos de la nota a actualizar
	 * @param int $id identificador de la nota
	 */
	public function updateNote ($data, $id) {
		foreach ($data as $k => $v) {
			$aux[':'.$k] = $v;
		}
		$aux[':'.$this->key] = $id;
		$result = $this->stor($aux);
		return $result;
	}
}