<?php
include 'https://obesity.es/core/config.php';
$temp = $_SERVER['REQUEST_URI'];

$short_temp = substr($temp, 0, 4);

//Compruebo si contiene alguno de los indicadores de idioma para cambiar el idioma del sistema
if (strpos($short_temp, '/es/') !== false || strpos($short_temp, '/es') !== false)
	$_SESSION['lang'] = 'es';
else if (strpos($short_temp, '/en/') !== false || strpos($short_temp, '/en') !== false)
	$_SESSION['lang'] = 'en';
else if (strpos($short_temp, '/de/') !== false || strpos($short_temp, '/de') !== false)
	$_SESSION['lang'] = 'de';

//Si no está declarado $_SESSION lo declaro con el idioma del explorador o con el predefinido
if(!isset($_SESSION['lang'])) {
	$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	if ($lang != 'es' && $lang != 'en' && $lang != 'de')
		$lang = $lang_default;
	$_SESSION['lang'] = $lang;
}
?>