<?php
	//Variable de envío de Formularios
	define('PATIENT', 0);
	define('ADMIN', 1);
	define('SUPERADMIN', 2);
	define('BLOQUEADO', 1);
	define('DESBLOQUEADO', 0);
	define('ESPANOL', 'es');
	define('INGLES', 'en');
	define('ALEMAN', 'de');
	$email_form = 'miguel.angel@innovadsl.es';
	$lang_default = 'es';
	
	
	
	/*****************************************************/
	
	
	//					     CONFIG                      //
	
	/*****************************************************/
	//codificaci�n del site (iso -> mssql / utf8 -> eoc)
	define("CODIFICACION", "utf-8");
	
	//DB CONSTANTS
	define("DB_HOST", "obesity.es");
	define("DB_USER", "emio");
	define("DB_PASS", "li42ba_4");
	define("DB_NAME", "obesity");
	define("DB_TYPE", "mysql"); //mysql/sqlsvr
	
	//páginas permitidas sin sesión
	$not_session_required = array(
		 '/mantenimiento/index.php' //hay que poner la url entera sin el dominio ej: /usuarios/acciones/listar.php
		,'/mantenimiento/php/contact.php'
		,'/index.php' 
	);
	
	//etiquetas permitidas a la hora de que los campos puedan tener código html (para proteger de xss)
	define("ALLOWED_HTML_TAGS",
		implode(",", 
			array(
				 "p"
				,"b"
				,"a[href]"
				,"i"
				,"ul"
				,"li"
				,"&"
				,"!"
			)
		)
	);
	
	//archivo de descarga
	define("DWFS","/common/dwfs.php?key=");
	
	//includes del header (principalmente los css)
    $header_includes = array(
    	 "css"		=> "" //lo normal es meter los css en la cabecera. Ejemplo para hacerlo seguro: encrypt($_SERVER['DOCUMENT_ROOT']."/css/prueba.css")
    	,"js"		=> "" //por si en alg�n momento debemos incluir un js en la cabecera. Ejemplo para hacerlo seguro: encrypt($_SERVER['DOCUMENT_ROOT']."/js/prueba.js")
    	,"script"	=> "" //por si queremos meter un script a pelo
    );
    
    //js a incluir en el pie
    $footer_includes = array(
    	 "js"		=> ""
    	,"script"	=> "" //por si queremos meter un script a pelo
    	,"css"		=> "" //por si en algún momento debemos incluir un css en el pie
    );
	
	$dias_semana = array ("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $meses 		 = array ("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	
    define("security_mail", "miguel.angel@innovadsl.es");
    
	//develpment potencia el debugeo de la aplicaci�n y configura cosas como el envío de emails
	define("DEVELOPMENT", serialize(
		array(
			 'enabled'			=> false
			,'development_mail'	=> 'miguel.angel@innovadsl.es'
			,'querys'			=> true
			,'query_params'		=> true
			,'query_result'		=> false
		))
	);
	
	//gesti�n de todo el m�dulo de mantenimiento
	define("MAINTENANCE",	serialize(
		 array(
			 'enabled' 			=> false
			,'allowed_ips' 		=> array('88.12.14.37')
			,'message'			=> "La web se encuentra en mantenimiento, sentimos<br>las molestias."
			,'company'			=> 'Obesity'
			//,'twitter'		=> '@company' a configurar en /mantenimiento/php/get-tweets.php 
			,'year'				=> 2015
			,'month'			=> 07
			,'day'				=> 02
			,'hour'				=> 11
			,'minute'			=> 00
			,'second'			=> 00
			,'about_header'		=> "Marcamos la diferencia"
			,'about_text'		=> "Lorem fistrum incididunt esse cillum reprehenderit magna a peich pecador exercitation commodo. Pecador duis aliqua cillum no puedor amatomaa llevame al sircoo. Incididunt apetecan laboris papaar papaar magna. Amatomaa reprehenderit amatomaa magna sit amet sexuarl. Adipisicing pecador a peich no te digo trigo por no llamarte Rodrigor a wan mamaar ahorarr se calle ust�e hasta luego Lucas magna."
			,'address'			=> "C/ Arturo Soria 262 Bajo Izq &#183; Madrid"
			,'telephone'		=> "914126884"
			,'email'			=> "miguel.angel@innovadsl.es"//este email es el que sacamos en la info
			,'maintenance_email'=> "miguel.angel@innovadsl.es"//este mail recibe los correos del formulario de contacto
			,'facebook_url'		=> "https://facebook.com/innovadsl"
			,'twitter_url'		=> "https://twitter.com/innovadsl"
			,'gplus_url'		=> "https://plus.google.com/innovadsl"
			,'pinterest_url'	=> "https://pinterest.com/innovadsl"
			,'youtube_url'		=> "https://youtube.com/innovadsl"
			,'linkedin_urk'		=> "https://linkedin.com/innovadsl"
		))
	);
	
	//en funci�n del sistema operativo las barras cambian (para el tema de subir archivos, moverlos etc)
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	    define("BARRA_SERVIDOR", "\\");
	} else {
	    define("BARRA_SERVIDOR", "/");
	}
	
	//carpeta temporal para hacer cosas
	define("TMP_DIR", $_SERVER['DOCUMENT_ROOT'].BARRA_SERVIDOR."tmp");
	
	//carpeta de archivos subidos
	define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT'].BARRA_SERVIDOR."uploads");
	
	//tama�o de los thumbnails
	define("THUMBNAIL_WIDTH", "236");
	define("THUMBNAIL_HEIGHT", "236");
?>	