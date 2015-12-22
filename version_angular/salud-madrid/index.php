<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; 

if (isset($_GET['page']) && $_GET['page'] != '') {
	$xml = 'salud-madrid/'.$_GET['page'];
	include $_GET['page'].'.php';
} else {
	$xml = 'salud-madrid';
	include 'salud-espana.php';
}

include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; 
?>