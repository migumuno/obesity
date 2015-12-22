<?php
session_start();
header('Location: /'.$_SESSION['lang'].$_GET['url']);
?>