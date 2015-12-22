<?php
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.patient.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.admin.php';
class Access {
	private $patient;
	private $admin;
	
	function Access($db) {
		$this->patient = new Patient($db);
		$this->admin = new Admin($db);
	}
	
	/**
	 * Controlo el acceso al panel comprobando si corresponden los valores pasados por $_POST
	 * @param int $type para saber si es admin, paciente
	 */
	public function check ($type) {
		switch ($type) {
			case PATIENT:
				$response = $this->patient->searchPatient($_POST['user']);
				if ($response->resultado) {
					if (encrypt($_POST['pass']) == $response->datos[0]['pass']) {
						$_SESSION['user'] = array(
							'access' => true
							,'id' => $response->datos[0]['id_patient']
							,'type' => PATIENT
							,'name' => $response->datos[0]['nombre'].' '.$response->datos[0]['apellidos']
							,'email' => $response->datos[0]['email']
						);
						$_SESSION['lang'] = $response->datos[0]['lang'];
						return true;
					} else 
						return false;
				} else 
					return false;
				break;
			case ADMIN:
				$response = $this->admin->searchAdmin($_POST['user']);
				if ($response->resultado) {
					if (encrypt($_POST['pass']) == $response->datos[0]['pass']) {
						if ($response->datos[0]['tipo'] == 0)
							$tipo = ADMIN;
						else if ($response->datos[0]['tipo'] == 1)
							$tipo = SUPERADMIN;
						else 
							$tipo = PATIENT;
							
						$_SESSION['user'] = array(
							'access' => true
							,'id' => $response->datos[0]['id_admin']
							,'type' => $tipo
							,'name' => $response->datos[0]['nombre']
							,'email' => $response->datos[0]['email']
						);
						$_SESSION['lang'] = 'es';
						return true;
					} else 
						return false;
				} else 
					return false;
				break;
			default:
				return false;
		}
	}
	
	public function activate () {
		$result = $this->patient->checkKey($_POST['user'], $_POST['key']);
		if ($result->resultado) {
			$datos = array();
			$datos[':id_patient'] = $result->datos[0]['id_patient'];
			$datos[':estado'] = DESBLOQUEADO;
			$datos[':keyphrase'] = null;
			$datos[':pass'] = encrypt($_POST['pass']);
			$result = $this->patient->stor($datos);
			if ($result->resultado)
				return true;
			else
				return false;
		} else 
			return false;
	}
	
	public function addAdmin () {
		$datos = array();
		$datos[':usuario'] = $_POST['user'];
		$datos[':pass'] = encrypt($_POST['pass']);
		$this->admin->insertAdmin($datos);
	}
	
	public function changePass ($search) {
		$result = $this->patient->searchPatient($search);
		if ($result->resultado) {
			$text = 'paciente'.date("l").date("Y").date("m").date("a").date("H").date("s").date("i").date("d").'njad';
			$key = encrypt($text);
			$datos = array();
			$datos['keyphrase'] = $key;
			$result2 = $this->patient->updatePatient($result->datos[0]['id_patient'], $datos);
			switch ($_SESSION['lang']) {
				case "en":
					$asunto = 'EMIO, recuperación de contraseña.';
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/panel/mails/changePass_en.html");
					break;
				case "de":
					$asunto = 'EMIO, recuperación de contraseña.';
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/panel/mails/changePass_de.html");
					break;
				default:
					$asunto = 'EMIO, recuperación de contraseña.';
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/panel/mails/changePass.html");
			}
			$cuerpo = str_replace("#KEY#", $key, $cuerpo);
			enviar_email($result->datos[0]['email'], $asunto, $cuerpo);
			return true;
		} else 
			return false;
	}
	
	public function passRecover () {
		
	}
}