<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.contacts.php';
if ($_POST['subject'] != '' || $_POST['body'] != '')
	exit;
$values = array();

$to = 'info@obesity.es';
if ($_POST['asunto'] == 'pacientes-internacionales' || $_POST['asunto'] == 'clinica-obesidad')
	$to = 'patients@obesity.es';

$cuerpo = file_get_contents($_SERVER['DOCUMENT_ROOT']."/includes/mailing/forms.html");

switch ($_POST['type']) {
	case "short":
		$tipo = 'consulta';
		break;
	case "long":
		$tipo = 'más info';
		break;
	case "contact":
		$tipo = 'contacto';
		break;
	default:
		$tipo = $_POST['type'];
}
		
$cuerpo = str_replace("#TYPE#", $_POST['asunto'].', '.$tipo, $cuerpo);
$cuerpo = str_replace("#LANG#", $_POST['lang'], $cuerpo);
$cuerpo = str_replace("#NAME#", $_POST['name'], $cuerpo);
$cuerpo = str_replace("#EMAIL#", $_POST['emilio'], $cuerpo);
$cuerpo = str_replace("#MESSAGE#", $_POST['txt'], $cuerpo);
$values[':type'] = $_POST['asunto'].'_'.$_POST['type'];
$values[':lang'] = $_POST['lang'];
$values[':name'] = $_POST['name'];
$values[':email'] = $_POST['emilio'];
$values[':message'] = $_POST['txt'];

if ($_POST['type'] == 'long' || $_POST['type'] == 'contact') {
	$cuerpo = str_replace("#TELF#", $_POST['telf'], $cuerpo);
	$cuerpo = str_replace("#DELIVER#", $_POST['deliver'], $cuerpo);
	$values[':telf'] = $_POST['telf'];
	$values[':deliver'] = $_POST['deliver'];
}

if ($_POST['type'] == 'contact') {
	$cuerpo = str_replace("#COUNTRY#", $_POST['country'], $cuerpo);
	$cuerpo = str_replace("#INTEREST#", $_POST['interest'], $cuerpo);
	$values[':country'] = $_POST['country'];
	$values[':interest'] = $_POST['interest'];
}

if ($_POST['type'] == 'llamamos') {
	$cuerpo = str_replace("#TELF#", $_POST['telf'], $cuerpo);
	$values[':telf'] = $_POST['telf'];
}

$cuerpo = str_replace("#TELF#", 'No procede', $cuerpo);
$cuerpo = str_replace("#DELIVER#", 'No procede', $cuerpo);
$cuerpo = str_replace("#COUNTRY#", 'No procede', $cuerpo);
$cuerpo = str_replace("#INTEREST#", 'No procede', $cuerpo);

if (isset($_POST['type']) && $_POST['type'] != '' && isset($_POST['name']) && $_POST['name'] != '') {
	enviar_email($to, 'Email de la web de EMIO', $cuerpo);
	$contacts = new Contacts($db);
	$response = $contacts->stor_contacts($values);
}
?>