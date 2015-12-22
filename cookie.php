<?php
$value = 'aceptada';
$time = ((time()+3600) * 24) * 90;
setcookie($_GET['name'], $value, $time, '/', 'www.obesity.es');
echo 'ok';
?>