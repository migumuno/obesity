<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; 

if (isset($_GET['page']) && $_GET['page'] != '') {
	include $_GET['page'].'.php';
	$xml = 'diagnostico-obesidad/'.$_GET['page'];
} else {
	include 'diagnostico-obesidad.php';
	$xml = 'diagnostico-obesidad';
}

include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; 
?>