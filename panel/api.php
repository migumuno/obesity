<?php
//Incluyo todos los archivos necesarios
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.manage.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.messages.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.admin.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.patient.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.notes.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.calendar.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.documentation.php';

//Inicializo la base de datos para todo el panel
$db = new db(BBDD);

if(!isset($_SESSION['user'])) {
	die();
	exit();
}
if (!$_SESSION['user']['access']) {
	die();
	exit();
}

if (!isset($_POST['action']))
	$data = json_decode(file_get_contents('php://input'), true);
else
	$data = $_POST;

switch ($data['action']) {
	case "get_all_messages":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['eliminado'] = 0;
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_read_messages":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['leido'] = 1;
		$filtros['eliminado'] = 0;
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_unread_messages":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['leido'] = 0;
		$filtros['eliminado'] = 0;
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_removed_messages":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['eliminado'] = 1;
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_send_messages":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['eliminado'] = 0;
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getSendMessages($_SESSION['user']['type'], $user_id, $filtros);
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "send_message":
		if ($_SESSION['user']['type'] == PATIENT) {
			$emisor = PATIENT;
			$patient = $_SESSION['user']['id'];
			/*$admin = $data['mensaje']['to'];*/
			$admin = 1;
			$idioma = es;
		} else {
			$emisor = ADMIN;
			/*$admin = $_SESSION['user']['id'];*/
			$admin = 1;
			$patient = $data['mensaje']['to'];
			$pct = new Patient($db);
			$info_paciente = $pct->getPatient('info', $patient);
			$idioma = $info_paciente->datos[0]['idioma'];
		}
		$msg = new Messages($db);
		$result = $msg->sendMessage($emisor, $patient, $admin, $data['mensaje']['mensaje'], $data['mensaje']['asunto']);
		if ($result->resultado && isset($info_paciente)) {
			if ($_SESSION['user']['type'] != PATIENT) {
				switch ($idioma) {
					case "en":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/message_en.html");
						$asunto = 'You have received a message in your EMIO account';
						break;
					case "de":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/message_en.html");
						$asunto = 'You have received a message in your EMIO account';
						break;
					default:
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/message.html");
						$asunto = 'Tiene un mensaje en EMIO';
				}
				enviar_email($info_paciente->datos[0]['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
			}
			echo 'ok';
		}
		break;
	case "set_read":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if ($result->resultado) {
			$result = $msg->setMsgState('read', $data['id']);
			if ($result->resultado)
				echo 'ok';
			else
				$result->error;
		} else 
			echo 'No encontrado';
		break;
	case "set_unread":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if ($result->resultado) {
			$result = $msg->setMsgState('unread', $data['id']);
			if ($result->resultado)
				echo 'ok';
			else
				$result->error;
		} else 
			echo 'No encontrado';
		break;
	case "set_erase":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if ($result->resultado) {
			$result = $msg->setMsgState('erase', $data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "set_eraseSend":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros, 'recibidos');
		if ($result->resultado) {
			$result = $msg->setMsgState('erase_send', $data['id']);
			if ($result->resultado)
				echo 'ok';
			else
				echo 'no actualizado';
		} else 
			echo 'no encontrado';
		break;
	case "set_unerase":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if ($result->resultado) {
			$result = $msg->setMsgState('unerase', $data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "set_erase_send":
		$msg = new Messages($db);
		$filtros = array();
		$filtros['id_message_user'] = $data['id'];
		if ($_SESSION['user']['type'] == PATIENT)
			$user_id = $_SESSION['user']['id'];
		else 
			$user_id = 1;
		$result = $msg->getMessages($_SESSION['user']['type'], $user_id, $filtros);
		if ($result->resultado) {
			$result = $msg->setMsgState('erase_send', $data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "get_admins":
		$admin = new Admin($db);
		$result = $admin->getAdminsList();
		if($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		}
		break;
	case "get_patients":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$patient = new Patient($db);
			$result = $patient->getPatientsList();
			if($result->resultado) {
				$encode = array();
				for ($i=0; $i<count($result->datos); $i++) {
				   $result->datos[$i]['nombre'] = $result->datos[$i]['nombre'].' '.$result->datos[$i]['apellidos'];
				   $encode[] = $result->datos[$i];
				}
				echo json_encode($encode); 
			}
		}
		break;
	case "get_patient_info":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$patient = new Patient($db);
			$result = $patient->getPatient('info', $data['id']);
			if($result->resultado) {
				echo json_encode($result->datos);
			}
		} else {
			$patient = new Patient($db);
			$result = $patient->getPatient('info', $_SESSION['user']['id']);
			if($result->resultado) {
				echo json_encode($result->datos);
			}
		}
		break;
	case "update_patient":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$patient = new Patient($db);
			$result = $patient->updatePatient($data['id'], $data['patient']);
			if ($result->resultado)
				echo 'ok';
			else
				echo 'error';
		} else if ($_SESSION['user']['type'] == PATIENT) {
			$patient = new Patient($db);
			$data['id'] = $_SESSION['user']['id'];
			$result = $patient->updatePatient($data['id'], $data['patient']);
			if ($result->resultado)
				echo 'ok';
			else
				echo 'error';
		}
		break;
	case "change_pass":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$admin = new Admin($db);
			if ($admin->changePass($_SESSION['user']['id'], $data['pass'], $data['pass_old']))
				echo 'ok';
			else 
				echo 'error';
		} else if ($_SESSION['user']['type'] == PATIENT) {
			$patient = new Patient($db);
			if ($patient->changePass($_SESSION['user']['id'], $data['pass'], $data['pass_old']))
				echo 'ok';
			else 
				echo 'error';
		}
		break;
	case "insert_patient":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			if (isset($data['patient'])) {
				$patient = new Patient($db);
				$text = 'paciente'.date("l").date("Y").date("m").date("a").date("H").date("s").date("i").date("d").'njad';
				$key = encrypt($text);
				$data['patient']['keyphrase'] = $key;
				$data['patient']['usuario'] = $data['patient']['email'];
				$result = $patient->insertPatient($data['patient']);
				if ($result->resultado) {
					switch ($data['patient']['lang']) {
						case "en":
							$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/welcome_en.html");
							$asunto = 'Welcome to the patient area at EMIO';
							break;
						case "de":
							$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/welcome_en.html");
							$asunto = 'Welcome to the patient area at EMIO';
							break;
						default:
							$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/welcome.html");
							$asunto = 'Bienvenido al Área de pacientes de EMIO';
					}
					$cuerpo = str_replace("#KEY#", $key, $cuerpo);
					enviar_email($data['patient']['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
					echo 'ok';
				} else
					echo 'Error, no hemos podido insertar el paciente.';
			} else
				echo 'Error, no has pasado ningún paciente.';
		} else
			echo 'Error, no tienes permisos.';
		break;
	case "insert_admin":
		if ($_SESSION['user']['type'] == SUPERADMIN) {
			if (isset($data['admin'])) {
				$admin = new Admin($db);
				$datos = array();
				$datos[':nombre'] = $data['admin']['name'];
				$datos[':usuario'] = $data['admin']['mail'];
				$datos[':email'] = $data['admin']['mail'];
				$datos[':pass'] = encrypt('123456');
				$result = $admin->insertAdmin($datos);
				if ($result->resultado) {
					$asunto = 'EMIO, alta como administrador.';
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/newAdmin.html");
					enviar_email($data['admin']['mail'], $asunto, $cuerpo);
					echo 'ok';
				} else 
					echo 'error';
			} else
				echo 'Error, no has pasado ningún admin.';
		} else
			echo 'Error, no tienes permisos.';
		break;
	case "get_notes":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$note = new Notes($db);
			$filters = array();
			add_filter($filters, 'id_patient', $data['id']);
			$result = $note->get($filters);
			if ($result->resultado) {
				$encode = array();
				for ($i=0; $i<count($result->datos); $i++) {
				   $encode[] = $result->datos[$i];
				}
				echo json_encode($encode); 
			} else 
				echo 'vacio';
		}
		break;
	case "insert_note":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$note = new Notes($db);
			$data['note']['id_admin'] = $_SESSION['user']['id'];
			$result = $note->insertNote($data['note']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "update_note":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$note = new Notes($db);
			$result = $note->updateNote($data['note'], $data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "delete_note":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$note = new Notes($db);
			$result = $note->delete($data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "insert_cita":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$calendar = new Calendar($db);
			if (!isset($data['calendar']['id_patient']))
				$data['calendar']['id_patient'] = $_SESSION['user']['id'];
			$result = $calendar->insertInCalendar('cita', $data['calendar']);
			if ($result->resultado) {
				$pct = new Patient($db);
				$info_paciente = $pct->getPatient('info', $data['calendar']['id_patient']);
				switch ($info_paciente->datos[0]['idioma']) {
					case "en":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita_en.html");
						$asunto = 'You have a new appointment in your EMIO account';
						break;
					case "de":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita_en.html");
						$asunto = 'You have a new appointment in your EMIO account';
						break;
					default:
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita.html");
						$asunto = 'Tienes una nueva cita en tu cuenta de EMIO.';
				}
				enviar_email($info_paciente->datos[0]['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
				echo 'ok';
			}
		}
		break;
	case "insert_recordatorio":
		$calendar = new Calendar($db);
		if (!isset($data['calendar']['id_patient']))
			$data['calendar']['id_patient'] = $_SESSION['user']['id'];
		$result = $calendar->insertInCalendar('recordatorio', $data['calendar']);
		if ($result->resultado) {
			$pct = new Patient($db);
			$info_paciente = $pct->getPatient('info', $data['calendar']['id_patient']);
			switch ($info_paciente->datos[0]['idioma']) {
				case "en":
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita_en.html");
					$asunto = 'You have a new reminder in your EMIO account';
					break;
				case "de":
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita_en.html");
					$asunto = 'You have a new reminder in your EMIO account';
					break;
				default:
					$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/cita.html");
					$asunto = 'Tiene un nuevo recordatorio en EMIO';
			}
			enviar_email($info_paciente->datos[0]['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
			echo 'ok';
		}
		break;
	case "update_cita":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$calendar = new Calendar($db);
			$result = $calendar->updateCalendar($data['calendar'], $data['id']);
			$evento = $calendar->getOneEvent('cita', $data['id']);
			if ($result->resultado) {
				$pct = new Patient($db);
				$info_paciente = $pct->getPatient('info', $evento->datos[0]['id_patient']);
				switch ($info_paciente->datos[0]['idioma']) {
					case "en":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita_en.html");
						$asunto = 'We have updated one of your appointments in your EMIO account';
						break;
					case "de":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita_en.html");
						$asunto = 'We have updated one of your appointments in your EMIO account';
						break;
					default:
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita.html");
						$asunto = 'Hemos actualizado una de sus citas en EMIO';
				}

				enviar_email($info_paciente->datos[0]['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
				echo 'ok';
			}
		}
		break;
	case "update_recordatorio":
		$calendar = new Calendar($db);
		if ($_SESSION['user']['type'] == PATIENT) {
			$filtros = array();
			$filtros['id_calendar'] = $data['id'];
			$result = $calendar->getFromPatient('recordatorio', $_SESSION['user']['id'], $filtros);
			if ($result->resultado) {
				$result = $calendar->updateCalendar($data['calendar'], $data['id']);
				if ($result->resultado)
					echo 'ok';
			}
		} else {
			$result = $calendar->updateCalendar($data['calendar'], $data['id']);
			$evento = $calendar->getOneEvent('recordatorio', $data['id']);
			if ($result->resultado) {
				$pct = new Patient($db);
				$info_paciente = $pct->getPatient('info', $evento->datos[0]['id_patient']);
				switch ($info_paciente->datos[0]['idioma']) {
					case "en":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita_en.html");
						$asunto = 'We have updated one of your reminders in your EMIO account';
						break;
					case "de":
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita_en.html");
						$asunto = 'We have updated one of your reminders in your EMIO account';
						break;
					default:
						$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/mails/update_cita.html");
						$asunto = 'Hemos actualizado una de sus recordatorios en EMIO';
				}

				$envio = enviar_email($info_paciente->datos[0]['email'], $asunto, $cuerpo, 'patients@obesity.es', 'EMIO');
				echo $envio;
			}
		}
		break;
	case "get_all_citas":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$calendar = new Calendar($db);
			$result = $calendar->getAll('cita');
			if ($result->resultado) {
				$encode = array();
				for ($i=0; $i<count($result->datos); $i++) {
				   $encode[] = $result->datos[$i];
				}
				echo json_encode($encode); 
			} else 
				echo 'vacio';
		}
		break;
	case "get_patient_citas":
		$calendar = new Calendar($db);
		$filters = array();
		if (!isset($data['id']))
			$data['id'] = $_SESSION['user']['id'];
		$result = $calendar->getFromPatient('cita', $data['id']);
		if ($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_all_recordatorios":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$calendar = new Calendar($db);
			$result = $calendar->getAll('recordatorio');
			if ($result->resultado) {
				$encode = array();
				for ($i=0; $i<count($result->datos); $i++) {
				   $encode[] = $result->datos[$i];
				}
				echo json_encode($encode); 
			} else 
				echo 'vacio';
		}
		break;
	case "get_patient_recordatorios":
		$calendar = new Calendar($db);
		$filters = array();
		if (!isset($data['id']))
			$data['id'] = $_SESSION['user']['id'];
		$result = $calendar->getFromPatient('recordatorio', $data['id']);
		if ($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_patient_events":
		$calendar = new Calendar($db);
		$filters = array();
		if (!isset($data['id']))
			$data['id'] = $_SESSION['user']['id'];
		$result = $calendar->getFromPatientEvents($data['id']);
		if ($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
			   $result->datos[$i]['comentario'] = '';
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "get_all_events":
		$calendar = new Calendar($db);
		$pct = new Patient($db);
		$filters = array();
		$result = $calendar->getAllEvents();
		if ($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
				$info_paciente = $pct->getPatient('info', $result->datos[$i]['id_patient']);
				$result->datos[$i]['name_patient'] = $info_paciente->datos[0]['nombre'].' '.$info_paciente->datos[0]['apellidos'];
			    $encode[$i] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
	case "delete_cita":
		if ($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == SUPERADMIN) {
			$calendar = new Calendar($db);
			$result = $calendar->delete($data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "delete_recordatorio":
		$calendar = new Calendar($db);
		if ($_SESSION['user']['type'] == PATIENT) {
			$filtros = array();
			$filtros['id_calendar'] = $data['id'];
			$result = $calendar->getFromPatient('recordatorio', $_SESSION['user']['id'], $filtros);
			if ($result->resultado) {
				$result = $calendar->delete($data['id']);
				if ($result->resultado)
					echo 'ok';
			}
		} else {
			$result = $calendar->delete($data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "upload_file":
		if (isset($_POST['paciente'])) {
			$patient = new Patient($db);
			$result = $patient->getPatient('info', $_POST['paciente']);
			if($result->resultado) {
				$destino = text2url($result->datos[0]['id_patient'].'_'.$result->datos[0]['nombre'].' '.$result->datos[0]['apellidos']);	
			}
		} else
			$destino = text2url($_SESSION['user']['id'].'_'.$_SESSION['user']['name']);
		$name = text2url($_POST['nombre']);
		$ruta = subirArchivo($_FILES['fichero'], $destino, $name);
		$documentation = new Documentation($db);
		$data = array();
		if (isset($_POST['paciente']))
			$data['id_patient'] = $_POST['paciente'];
		else
			$data['id_patient'] = $_SESSION['user']['id'];
		$data['emisor'] = $_SESSION['user']['type'];
		$data['url'] = $ruta;
		$data['nombre'] = $_POST['nombre'];
		$result = $documentation->insertDocumentation($data);
		if ($result->resultado)
			echo 'ok';
		break;
	case "erase_file":
		$documentation = new Documentation($db);
		if ($_SESSION['user']['type'] == PATIENT) {
			$filtros = array();
			add_filter($filtros, 'id_documentation', $data['id']);
			add_filter($filtros, 'id_patient', $_SESSION['user']['id']);
			$result = $documentation->get($filtros);
			if ($result->resultado) {
				$datos = array();
				$datos['eliminado_paciente'] = 1;
				$result = $documentation->updateDocumentation($datos, $data['id']);
				if ($result->resultado)
					echo 'ok';
			}
		} else {
			$datos = array();
			$datos['eliminado_admin'] = 1;
			$result = $documentation->updateDocumentation($datos, $data['id']);
			if ($result->resultado)
				echo 'ok';
		}
		break;
	case "get_files":
		$documentation = new Documentation($db);
		$patient = new Patient($db);
		$filtros = array();
		
		if (isset($data['paciente']))
			add_filter($filtros, 'id_patient', $data['paciente']);
		else {
			if ($_SESSION['user']['type'] == PATIENT)
				add_filter($filtros, 'id_patient', $_SESSION['user']['id']);
		}
		
		if ($_SESSION['user']['type'] == PATIENT)
			add_filter($filtros, 'eliminado_paciente', 0);
		else
			add_filter($filtros, 'eliminado_admin', 0);
		if (isset($data['limit']))
			$result = $documentation->get($filtros, '*', null, 'LIMIT '.$data['limit']);
		else
			$result = $documentation->get($filtros);
		if ($result->resultado) {
			$encode = array();
			for ($i=0; $i<count($result->datos); $i++) {
				$result->datos[$i]['url'] = '/common/dwfs.php?key='.encrypt(UPLOAD_DIR.BARRA_SERVIDOR.$result->datos[$i]['url'].'@@'.$result->datos[$i]['nombre']);
				$resultP = $patient->getPatient('info', $result->datos[$i]['id_patient']);
				if($resultP->resultado) {
					$result->datos[$i]['remitente'] = $resultP->datos[0]['nombre']." ".$resultP->datos[0]['apellidos'];
				}
				
			   $encode[] = $result->datos[$i];
			}
			echo json_encode($encode); 
		} else 
			echo 'vacio';
		break;
}