<?php
if (isset($_GET['query'])) {
	switch ($_GET['query']) {
		case 'last_posts':
			include 'core/config.php'; 
			include 'classes/Bd/class.wp_posts.php';
			$db = new db('blog');
			$Wp_posts = new Wp_posts($db);
			$response = $Wp_posts->get_last_wp_posts($_GET['lang']);
			if($response->resultado){
				$xml = $response->datos;
			} else{
				$xml = array();
			}
			break;
		case 'xml':
			$xml = simplexml_load_file("xml/".$_GET['xml']);
			break;
		default:
			$xml = array();
	}
}

$json = json_encode($xml);
echo $json;
?>