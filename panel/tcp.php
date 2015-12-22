<?php
$data = json_decode(file_get_contents('php://input'), true);
$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT']."/xml/".$data['xml'].'.xml');
$json = json_encode($xml);
echo $json;