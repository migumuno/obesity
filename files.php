<?php
$files = array();
$dir = opendir('img/equipo/');
while ($archivo = readdir($dir)) {
	if (!is_dir($archivo) && (strpos($archivo, 'jpg') != false || strpos($archivo, 'jpeg') != false || strpos($archivo, 'png') != false)) {
		$archivo = explode('.', $archivo);
		$files[] = $archivo[0];
	}
}

$dom = new DOMDocument("1.0", "UTF-8");
$images = $dom->createElement('img');
for ($i=0; $i<count($files); $i++) {
	$img = $dom->createElement($files[$i]);
	$seo = $dom->createElement('seo');
	$seo->appendChild($dom->createElement('es', ''));
	$seo->appendChild($dom->createElement('en', ''));
	$seo->appendChild($dom->createElement('de', ''));
	$img->appendChild($seo);
	$images->appendChild($img);
}
$dom->appendChild($images);
$dom->saveXML();
$dom->formatOutput = true;
$dom->save('xml/equipo.xml');