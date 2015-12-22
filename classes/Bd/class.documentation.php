<?php
class Documentation extends Manage {
	
	
	function Documentation($db) {
		$this->table = 'documentation';
		$this->key = 'id_documentation';
		$this->db = $db;
	}
	
	/**
	 * Crea una nueva nota
	 * @param array $data datos de la nota
	 */
	public function insertDocumentation ($data) {
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
	public function updateDocumentation ($data, $id) {
		foreach ($data as $k => $v) {
			$aux[':'.$k] = $v;
		}
		$aux[':'.$this->key] = $id;
		$result = $this->stor($aux);
		return $result;
	}
}