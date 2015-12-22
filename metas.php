<?php
$xml_file = '../xml'.str_replace("/es", "", $_SERVER['REQUEST_URI']);
$xml_code = simplexml_load_file($xml_file.'.xml');
print_r($xml_code);
?>