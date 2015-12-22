<?php
//Incluyo todos los archivos necesarios
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.manage.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/Security/class.access.php';

//Inicializo la base de datos para todo el panel
$db = new db(BBDD);

//Controlo el acceso al panel
switch ($_POST['access']) {
	case "login":
		$access = new Access($db);
		if (!$access->check(PATIENT))
			expulsion_seguridad('/?msg=login');
		break;
	case "adminLogin":
		$access = new Access($db);
		if (!$access->check(ADMIN))
			expulsion_seguridad('/');
		break;
	case "logout":
		expulsion_seguridad('/');
	case "activate":
		$access = new Access($db);
		if ($_POST['pass'] == $_POST['passVerify']) {
			if (!$access->activate())
				expulsion_seguridad('/?msg=errorActivate');
			else 
				expulsion_seguridad('/?msg=activate');
		} else 
			expulsion_seguridad('/?msg=errorActivate');
		break;
	case "changePass":
		$access = new Access($db);
		if (!$access->changePass($_POST['user']))
			expulsion_seguridad('/?msg=errorChange');
		else {
			expulsion_seguridad('/?msg=changePass');
		}
		break;
	default:
		if(!isset($_SESSION['user']))
			expulsion_seguridad('/');
		else 
			if (!$_SESSION['user']['access'])
				expulsion_seguridad('/');
}

//Controlo la ejecución de acciones que me pasan por $_GET
if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case "logout":
			expulsion_seguridad('/');
			break;
		case "language":
			switch ($_GET['lang']) {
				case ESPANOL:
					$_SESSION['lang'] = ESPANOL;
					break;
				case INGLES:
					$_SESSION['lang'] = INGLES;
					break;
				case ALEMAN:
					$_SESSION['lang'] = ALEMAN;
					break;
				default:
					$_SESSION['lang'] = ESPANOL;
			}
	}
}

//Si no está declarado $_SESSION['lang'] lo declaro con el idioma del explorador o con el predefinido
if(!isset($_SESSION['lang'])) {
	$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	if ($lang != 'es' && $lang != 'en' && $lang != 'de')
		$lang = $lang_default;
	$_SESSION['lang'] = $lang;
}
?>