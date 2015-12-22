<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; 

if (isset($_GET['page']) && $_GET['page'] != '') {
	include $_GET['page'].'.php';
	$xml = 'instituto-obesidad/'.$_GET['page'];
} else {
	include 'instituto-obesidad.php';
	$xml = 'instituto-obesidad';
}

include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; 
?>