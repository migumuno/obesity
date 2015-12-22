<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
$xml = 'portada';
?>

<div class="tarjetas">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php
				$tarjetas = $xml_code->cards->card;
				for ($i=0; $i<count($tarjetas); $i++) {
					echo '
					<div class="col-md-3 col-sm-6 tarjeta">
						<div class="titulo titulo_caracteristica">'.$tarjetas[$i]->title->$_SESSION['lang'].'</div>
						<div class="contenido_caracteristica">
							<div class="img_tarjeta"><img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img.'"></div>
							<div class="txt_contenido_tarjeta"><p class="txt_tarjeta">'.traducirStringXml($tarjetas[$i]->text->$_SESSION['lang']).'</p></div>
							<div class="boton_tarjeta"><a href="/'.$_SESSION['lang'].$tarjetas[$i]->link->$_SESSION['lang'].'"><button class="boton">'.$diccionario->buttons->more_info->$_SESSION['lang'].'</button></a></div>
						</div>
					</div>
					';
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php
if (!$enlace = mysql_connect('obesity.es', 'wordpress_e', 'OK4!t2sJ3l')) {
    echo 'No pudo conectarse a mysql';
    exit;
}

if (!mysql_select_db('wordpress_7', $enlace)) {
    echo 'No pudo seleccionar la base de datos';
    exit;
}

switch ($_SESSION['lang']) {
	case 'es':
		$table = wp_2_posts;
		$table2 = wp_2_postmeta;
		break;
	case 'en':
		$table = wp_3_posts;
		$table2 = wp_3_postmeta;
		break;
	case 'de':
		$table = wp_4_posts;
		$table2 = wp_4_postmeta;
		break;
	default:
		$table = wp_posts;
}

//preparo la query
$sql = "
	SELECT wp1.post_title AS titulo, wp1.ID, wp1.post_date AS fecha, wp1.post_content AS contenido, wp2.guid AS img, wp1.post_name AS link
	FROM ".$table." wp1
	    LEFT JOIN ".$table2." pm ON (wp1.ID = pm.post_id)
		LEFT JOIN ".$table." wp2 ON (pm.meta_value = wp2.ID)
	WHERE wp1.post_type = 'post' 
		AND wp1.post_status = 'publish'
		AND pm.meta_key = '_thumbnail_id'
	ORDER BY wp1.post_date DESC
	LIMIT 3;
";
$resultado = mysql_query($sql, $enlace);
if (mysql_num_rows($resultado) > 0) {
	echo '
	<div class="blog">
		<div class="container">
			<div class="titulo_blog">'.$diccionario->texts->blog_title->$_SESSION['lang'].'</div>
			<div class="row">
				<div class="col-md-12">';
	while ($fila = mysql_fetch_assoc($resultado)) {
	    echo '
	    <div class="col-md-4">
			<div class="articulo">
				<div class="img_articulo"><img src="'.$fila['img'].'" width="100%"></div>
				<div class="contenido_articulo">
					<div class="fecha_articulo">'.utf8_encode($fila['fecha']).'</div>
					<div class="titulo titulo_articulo">'.utf8_encode($fila['titulo']).'</div>
					<div class="txt_articulo">'.substr(utf8_encode($fila['contenido']), 0, 150).'...</div>
					<div class="boton_articulo"><a href="/blog/'.$_SESSION['lang'].'/'.utf8_encode($fila['link']).'"><button class="boton">'.$diccionario->buttons->continue->$_SESSION['lang'].'</button></a></div>
				</div>
			</div>
		</div>
	    ';
	}
}
?>
			</div>
		</div>
	</div>
</div>
		
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>