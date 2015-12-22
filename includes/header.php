<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$temp = $_SERVER['REQUEST_URI'];

// Registro de campañas
if (isset($_GET['campana']) && isset($_GET['anuncio'])) {
	include $_SERVER['DOCUMENT_ROOT'].'/classes/Bd/class.campanas.php';

	$values = array();
	$values[':campana'] = $_GET['campana'];
	$values[':anuncio'] = $_GET['anuncio'];
	$values[':page'] = $temp;

	$campanas = new Campanas($db);
	$response = $campanas->stor_campanas($values);
}

//OBTENGO LA RUTA AL XML
$file = $_SERVER['SCRIPT_NAME'];
$file = str_replace('/', '', $file);
$file = str_replace('index.php', '', $file);
$file2 = $_SERVER['QUERY_STRING'];
$file2 = str_replace('method=', '', $file2);
$file2 = str_replace('page=', '', $file2);
if($file2 == '')
	$xml_file = $file;
else
	$xml_file = $file.'/'.$file2;

if($xml_file == '')
	$xml_file = 'portada';
	
$short_temp = substr($temp, 0, 4);

//Compruebo si contiene alguno de los indicadores de idioma para cambiar el idioma del sistema
if (strpos($short_temp, '/es/') !== false || strpos($short_temp, '/es') !== false)
	$_SESSION['lang'] = 'es';
else if (strpos($short_temp, '/en/') !== false || strpos($short_temp, '/en') !== false)
	$_SESSION['lang'] = 'en';
else if (strpos($short_temp, '/de/') !== false || strpos($short_temp, '/de') !== false)
	$_SESSION['lang'] = 'de';

//Si no está declarado $_SESSION lo declaro con el idioma del explorador o con el predefinido
if(!isset($_SESSION['lang'])) {
	$lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	if ($lang != 'es' && $lang != 'en' && $lang != 'de')
		$lang = $lang_default;
	$_SESSION['lang'] = $lang;
	echo '<meta http-equiv="refresh" content="0; url=/"'.$lang.' />';
}

if ($temp == '/')
	header('Location: /'.$_SESSION['lang'].'/');

//
/*if (str_replace("/".$_SESSION['lang']."/", "", $temp) == '')
	$dir = '/'.$_SESSION['lang'].'/portada';
else if ($temp == '/')
	$dir = '/'.$_SESSION['lang'].'/portada';
else if (substr($temp, -1) == "/")
	$dir = substr($temp, 0, -1);
else 
	$dir = $temp;*/

$xml_file = $_SERVER['DOCUMENT_ROOT'].'/xml/'.$xml_file;

/*********Variables de contenido********/

$xml_code = simplexml_load_file($xml_file.'.xml');
$diccionario = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/dictionary.xml');
$menu = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/menu.xml');
$pie = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/footer.xml');
$creditos = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/creditos.xml');

/*********Fin Variables de contenido********/

$urls_name = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/url.xml');

$haystack_form = array(
	"/es/salud-madrid/"
	,"/es/salud-madrid"
	,"/es/salud-madrid/alojamiento"
	,"/es/salud-madrid/museos"
	,"/es/salud-madrid/compras"
	,"/es/salud-madrid/espectaculos"
	,"/es/salud-madrid/eventos-y-ferias"
	,"/es/clinica-obesidad/"
	,"/en/madrid-healthcare"
	,"/en/madrid-healthcare/"
	,"/en/madrid-healthcare/accomodation"
	,"/en/madrid-healthcare/museums"
	,"/en/madrid-healthcare/shopping"
	,"/en/madrid-healthcare/shows"
	,"/en/madrid-healthcare/events-and-fairs"
	,"/en/obesity-clinic/"
	,"/en/obesity-clinic"
	,"/de/gesundheit-madrid"
	,"/de/gesundheit-madrid/"
	,"/de/gesundheit-madrid/unterkunft"
	,"/de/gesundheit-madrid/museen"
	,"/de/gesundheit-madrid/einkaufen"
	,"/de/gesundheit-madrid/shows"
	,"/de/gesundheit-madrid/events-und-messen"
	,"/de/klinik-fettleibigkeit"
	,"/de/klinik-fettleibigkeit/"
	,"/es/pacientes-internacionales"
	,"/es/pacientes-internacionales/"
	,"/en/international-patients"
	,"/en/international-patients/"
	,"/de/internationale-patienten"
	,"/de/internationale-patienten/"
);

$current_url =  substr($temp, 4);
$current_url = explode('/', $current_url);

switch ($_SESSION['lang']) {
	case "es":
		$html_lang = 'es';
		break;
	case "en":
		$html_lang = 'en';
		break;
	case "de":
		$html_lang = 'de';
		break;
	default:
		$html_lang = 'es';
}

/*echo $urls_name.'->'.$_SESSION['lang'].'->'.$current_url[0].'->en';*/

?>
<!DOCTYPE html>
<html ng-app="web" ng-controller="PageController as page"  ng-cloak lang="<?php echo $html_lang ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $xml_code->metas->title->$_SESSION['lang']; ?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<meta name="description" content="<?php echo $xml_code->metas->description->$_SESSION['lang']; ?>">
<meta name="keywords" content="<?php echo $xml_code->metas->keywords->$_SESSION['lang']; ?>">
<meta name="author" content="EMIO">
<meta name="geography" content="spain">
<meta http-equiv="Content-Language" content="<?= $html_lang ?>"/> 
<meta property="og:locale" content="es_<?= strtoupper($html_lang) ?>" />
<meta http-equiv="expires" content="never">
<meta name="revisit-after" content="30 days">
<meta name="distribution" content="global">
<meta name="robots" content="index,follow">
<meta name="country" content="spain">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link rel="stylesheet" href="/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<script src="/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='/css/loading-bar.css' type='text/css' media='all' />
<script type='text/javascript' src='/js/loading-bar.js'></script>

<?php 
switch ($_SESSION['lang']) {
	case 'en':
		echo '<script type="text/javascript" src="/js/cookie_en.js"></script>';
		break;
	case 'de':
		echo '<script type="text/javascript" src="/js/cookie_de.js"></script>';
		break;
	default:
		echo '<script type="text/javascript" src="/js/cookie.js"></script>';
}
?>
	
<link rel="stylesheet" href="/css/app.css">
<!--[if IE]>
  <style type="text/css">
    @import ("<?php echo $_SERVER['DOCUMENT_ROOT'] ?>/css/ie8.css");
  </style>
<![endif]-->
<!--<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64238526-1', 'auto');
  ga('send', 'pageview');

</script>-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67441079-1', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/javascript" src="http://obesity.es/livechat/php/app.php?widget-init.js"></script>
</head>
<body>
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"><?php echo $diccionario->texts->recived->$_SESSION['lang'] ?></h4>
	        </div>
	        <div class="modal-body">
	          <p><?php echo $diccionario->texts->mail_send->$_SESSION['lang'] ?></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $diccionario->texts->close->$_SESSION['lang'] ?></button>
	        </div>
	      </div>
	      
	    </div>
	</div>
	<div class="container-fluid">
		<div class="lang">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-sm-6 lang_left">
							<ul>
								<?php 
									if ($current_url[1] == '6-month-intragastric-balloon')
										$current_url[1] = '_6-month-intragastric-balloon';
								?>
								<li ng-hide="lang=='es'"><a href="/es/<?php echo $urls_name->$_SESSION['lang']->$current_url[0]->es.$urls_name->$_SESSION['lang']->$current_url[0]->$current_url[1]->es; ?>"><img title="español" alt="español" src="/img/es.png"> <small>Español</small></a></li>
								<li ng-hide="lang=='en'"><a href="/en/<?php echo $urls_name->$_SESSION['lang']->$current_url[0]->en.$urls_name->$_SESSION['lang']->$current_url[0]->$current_url[1]->en; ?>"><img title="english" alt="english" src="/img/en.png"> <small>English</small></a></li>
								<li ng-hide="lang=='de'"><a href="/de/<?php echo $urls_name->$_SESSION['lang']->$current_url[0]->de.$urls_name->$_SESSION['lang']->$current_url[0]->$current_url[1]->de; ?>"><img title="deutsch" alt="deutsch" src="/img/de.png"> <small>Deutsch</small></a></li>
							</ul>
						</div>
						<!-- <div class="col-sm-6 lang_right">
							<ul>
								<li><img title="{{footer.img.facebook.alt[lang]}}" alt="{{footer.img.facebook.alt[lang]}}" src="/img/icons/{{footer.img.facebook.link}}"></li>
								<li><img title="{{footer.img.twitter.alt[lang]}}" alt="{{footer.img.twitter.alt[lang]}}" src="/img/icons/{{footer.img.twitter.link}}"></li>
								<li><img title="{{footer.img.rss.alt[lang]}}" alt="{{footer.img.rss.alt[lang]}}" src="/img/icons/{{footer.img.rss.link}}"></li>
								<li><img title="{{footer.img.youtube.alt[lang]}}" alt="{{footer.img.youtube.alt[lang]}}" src="/img/icons/{{footer.img.youtube.link}}"></li>
								<li><button class="boton_admin"><img title="{{footer.img.lock.alt[lang]}}" alt="{{footer.img.lock.alt[lang]}}" src="/img/icons/{{footer.img.lock.link}}"> {{dictionary.buttons.patient[lang]}}</button></li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div  class="skype visible-xs-block visible-sm-block">
			<div class="container">
				<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
				<div id="SkypeButton_Call_ObesityHealthSpain_2">
				  <script type="text/javascript">
				    Skype.ui({
				      "name": "call",
				      "element": "SkypeButton_Call_ObesityHealthSpain_2",
				      "participants": ["ObesityHealthSpain"],
					   "imageColor": "blue",
				      "imageSize": 24
				    });
				  </script>
				</div>
			</div>
		</div>
		<div class="cabecera visible-lg-block">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-md-4 logo"><a href="/"><img title="european medical institute of obesity" alt="european medical institute of obesity" src="/img/logo_emio.png"></a></div>
						<div class="col-md-8">european medical institute of obesity</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bootstrap_menu">
			<nav class="navbar navbar-default visible-lg-block">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#"></a>
			    </div>
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav navbar-center">
			      	<?php 
			      	$menu_sup = $menu->menu->item;
			      	for ($i=0; $i<count($menu_sup); $i++) {
			      		echo '<li class="dropdown">';
						if (count($menu_sup[$i]->submenu->item) > 0) {
							echo '
							<span>
								<a href="#"" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$menu_sup[$i]->name->$_SESSION['lang'].' <span class="caret"></span></a>
								<ul class="dropdown-menu">';
									$submenu = $menu_sup[$i]->submenu->item;
									for ($h=0; $h<count($submenu); $h++) {
										echo '<li><a href="/'.$_SESSION['lang'].$submenu[$h]->link->$_SESSION['lang'].'">'.$submenu[$h]->name->$_SESSION['lang'].'</a></li>';
									}
								echo '</ul>
							</span>';
						} else {
							if (isset($menu_sup[$i]->id) && $menu_sup[$i]->id == 'blog') {
								echo '<span><a href="'.$menu_sup[$i]->link->$_SESSION['lang'].'">'.$menu_sup[$i]->name->$_SESSION['lang'].' </a></span>';
							} else {
								echo '<span><a href="/'.$_SESSION['lang'].$menu_sup[$i]->link->$_SESSION['lang'].'">'.$menu_sup[$i]->name->$_SESSION['lang'].' </a></span>';
							}
						}
				      	echo '</li>';
			      	}
			      	?>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</div>
		<div class="text-uppercase hidden-lg">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
						<span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><img title="european medical institute of obesity" alt="european medical institute of obesity" src="/img/logo_emio.png" height="100%"></a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			      <ul class="nav navbar-nav">
				      <?php 
				      $menu_sup = $menu->menu->item;
				      for ($i=0; $i<count($menu_sup); $i++) {
				      	echo '<li class="dropdown menu_bar">';
				      		if (count($menu_sup[$i]->submenu->item) > 0) {
				      			echo '
								<span>
									<a href="#"" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$menu_sup[$i]->name->$_SESSION['lang'].' <span class="caret"></span></a>
									<ul class="dropdown-menu">';
						      			$submenu = $menu_sup[$i]->submenu->item;
						      			for ($h=0; $h<count($submenu); $h++) {
						      				echo '<li><a href="/'.$_SESSION['lang'].$submenu[$h]->link->$_SESSION['lang'].'">'.$submenu[$h]->name->$_SESSION['lang'].'</a></li>';
						      			}
					      			echo '</ul>
								</span>';
				      		} else {
				      			if (isset($menu_sup[$i]->id) && $menu_sup[$i]->id == 'blog') {
				      				echo '<span><a href="'.$menu_sup[$i]->link->$_SESSION['lang'].'">'.$menu_sup[$i]->name->$_SESSION['lang'].' </a></span>';
				      			} else {
				      				echo '<span><a href="/'.$_SESSION['lang'].$menu_sup[$i]->link->$_SESSION['lang'].'">'.$menu_sup[$i]->name->$_SESSION['lang'].' </a></span>';
				      			}
				      		}
				      	echo '</li>';
				      }
				      ?>
				  </ul>
				</div>
			</nav>
		</div>
		<div class="contacto text-uppercase hidden-sm hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<?php 
						$contacto = $menu->contacto->item;
						for ($i=0; $i<count($contacto); $i++) {
							switch ($i) {
								case 0:
									echo '
										<div class="col-xs-3 contact_min menu_item_left">
											<span><a href="'.$contacto[$i]->link->$_SESSION['lang'].'" ng-click="changeLlamamos()">'.$contacto[$i]->name->$_SESSION['lang'].' <br><small class="contact_padding">'.$contacto[$i]->subname->$_SESSION['lang'].'</small></a></span>
										</div>
									';
									break;
								case 2:
									echo '
									<div class="col-xs-3 menu_item contact_min">
										<span>
											<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
											<div id="SkypeButton_Call_ObesityHealthSpain_1">
											  <script type="text/javascript">
											    Skype.ui({
											      "name": "call",
											      "element": "SkypeButton_Call_ObesityHealthSpain_1",
											      "participants": ["ObesityHealthSpain"],
												   "imageColor": "white",
											      "imageSize": 16
											    });
											  </script>
												<small>ObesityHealthSpain</small>
											</div>
										</span>
									</div>
									';
									break;
								default:
									echo '
									<div class="col-xs-3 menu_item contact_min">
										<span><a href="'.$contacto[$i]->link->$_SESSION['lang'].'" target="_blank">'.$contacto[$i]->name->$_SESSION['lang'].' <br><small class="contact_padding">'.$contacto[$i]->subname->$_SESSION['lang'].'</small></a></span>
									</div>
									';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div ng-show="llamamos" class="form_llamamos">
				<div class="row">
					<div class="col-xs-12">
						<div class="form" name="form_llamamos">
							<form name="form_llamamos" method="post" novalidate>
								<input ng-model="call.name" type="text" name="name" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
								<div ng-show="form_llamamos.name.$touched && !form_llamamos.$pristine">
									<span ng-show="form_llamamos.name.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?>.</span>
								</div>
								<input ng-model="call.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>" required>
								<div ng-show="form_llamamos.telf.$touched && !form_llamamos.$pristine">
									<span ng-show="form_llamamos.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
				  					<span ng-show="form_llamamos.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
								</div>
								<span class="form_check"><input ng-model="politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
								<input class="boton" ng-click="sendMailLlamamos()" type="submit" value="<?php echo $diccionario->fields->callme->$_SESSION['lang'] ?>" ng-disabled="!form_llamamos.$valid">
							</form>
							<div class="text-right"><?php echo $diccionario->texts->close->$_SESSION['lang'] ?> <i ng-click="changeLlamamos()" class="btn glyphicon glyphicon-remove"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if (($_SERVER['REQUEST_URI'] != '/es/legal/') && ($_SERVER['REQUEST_URI']!= '/es/legal') && ($_SERVER['REQUEST_URI']!= '/en/legal/') && ($_SERVER['REQUEST_URI']!= '/en/legal') && ($_SERVER['REQUEST_URI']!= '/de/legal/') && ($_SERVER['REQUEST_URI']!= '/de/legal') && ($_SERVER['REQUEST_URI']!= '/legal') && ($_SERVER['REQUEST_URI']!= '/legal/')) { ?>
			<div id="slider" class="hide_animation">
				<div class="container">
					<div class="row">
						<div class="col-md-12 slider_content">
							<!-- <div ng-if="contenido.messages.img != undefined" class="canvas_slider visible-lg-block visible-md-block"><img title="{{contenido.messages.alt[lang]}}" alt="{{contenido.messages.alt[lang]}}" src="/img/{{contenido.messages.img}}"></div> -->
							<div class="col-ld-7 col-md-6 col-sm-10 without_padding">
								<?php if (($_SERVER['REQUEST_URI']!= '/index.php' && $_SERVER['REQUEST_URI']!== '/')) { 
									if (isset($xml_code->messages->message)) {
										$sliders = $xml_code->messages->message;
										if (count($sliders) > 0) {
											for ($i=0; $i<count($sliders); $i++) {
												echo '<span ng-show="sliderSelected('.$i.')">';
													if (isset($sliders[$i]->img))
														echo '<div class="img_slider"><img title="'.$sliders[$i]->alt->$_SESSION['lang'].'" alt="'.$sliders[$i]->alt->$_SESSION['lang'].'" src="/img/txt_sliders/'.$sliders[$i]->img->$_SESSION['lang'].'"></div>';
												echo '</span>';
											}
										} else {
											echo '<span ng-show="sliderSelected(0)">';
												echo '<div class="img_slider"><img title="'.$sliders->alt->$_SESSION['lang'].'" alt="'.$sliders->alt->$_SESSION['lang'].'" src="/img/txt_sliders/'.$sliders->img->$_SESSION['lang'].'"></div>';
											echo '</span>';
										}
									}
								} ?>
							</div>
							<div class="col-xs-2 without_padding"></div>
							<?php if (!in_array($_SERVER['REQUEST_URI'], $haystack_form)) {	?>
								<div class="col-ld-3 col-md-4 col-sm-5 visible-lg-block without_padding">
									<div class="slider_form">
									<?php if ($_SERVER['REQUEST_URI']!= '/index.php' && $_SERVER['REQUEST_URI']!== '/') {?>
										<div class="row">
											<div class="col-xs-12">
												<div ng-class="{'col-xs-6 form_title':formSelected(2), 'col-xs-6 form_title_des':formSelected(1)}"><a ng-click="changeForm(1)" href=""><?php echo $diccionario->buttons->expert->$_SESSION['lang'] ?></a></div>
												<div ng-class="{'col-xs-6 form_title':formSelected(1), 'col-xs-6 form_title_des':formSelected(2)}"><a ng-click="changeForm(2)" href=""><?php echo $diccionario->buttons->request->$_SESSION['lang'] ?></a></div>
											</div>
										</div>
										<div ng-show="formSelected(1)" class="form">
											<form name="consulta" novalidate>
												<input ng-model="short.name" type="text" name="name" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
												<div ng-show="consulta.name.$touched && !consulta.$pristine">
													<span ng-show="consulta.name.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?>.</span>
												</div>
												<input ng-model="short.email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>" required>
												<div ng-show="consulta.email.$touched && !consulta.$pristine">
													<span ng-show="consulta.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
													<span ng-show="consulta.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
												</div>
												<textarea name="txt" ng-model="short.txt" rows="4" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>" required></textarea>
												<div ng-show="consulta.txt.$touched && !consulta.$pristine">
													<span ng-show="consulta.txt.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
												</div>
												<span class="form_check"><input ng-model="short.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
												<input type="submit" ng-click="sendMailConsulta()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!consulta.$valid">
											</form>
										</div>
										<div ng-show="formSelected(2)" class="form">
											<form name="mas_info" novalidate>
												<div class="row">
													<div class="col-xs-12">
														<div class="col-md-6 col-sm-12">
															<input ng-model="long.name" type="text" name="nombre" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
															<div ng-show="mas_info.nombre.$touched && !mas_info.$pristine">
																<span ng-show="mas_info.nombre.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?></span>
															</div>
															<textarea ng-model="long.message" name="message" rows="5" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>" required></textarea>
															<div ng-show="mas_info.message.$touched && !mas_info.$pristine">
																<span ng-show="mas_info.message.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
															</div>
														</div>
														<div class="col-md-6 col-sm-12">
															<input ng-model="long.email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>" required>
															<div ng-show="mas_info.email.$touched && !mas_info.$pristine">
																<span ng-show="mas_info.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
																<span ng-show="mas_info.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
															</div>
															<input ng-model="long.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>" required>
															<div ng-show="mas_info.telf.$touched && !mas_info.$pristine">
																<span ng-show="mas_info.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
											  					<span ng-show="mas_info.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
															</div>
															<div class="canal">
																<small><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?></small><br>
																<span class="form_check"><input ng-model="long.canal" type="radio" name="canal" value="email" required> <small><?php echo $diccionario->fields->mail->$_SESSION['lang'] ?></small>
																<input ng-model="long.canal" type="radio" name="canal" value="telf"> <small><?php echo $diccionario->fields->telf->$_SESSION['lang'] ?></small></span>
																<div ng-show="mas_info.$submitted">
																	<span ng-show="mas_info.canal.$error.required" class="alert"><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?></span>
																</div>
															</div>
															<span class="form_check"><input ng-model="long.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
															<input class="boton" type="submit" ng-click="sendMailMasInfo()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!mas_info.$valid">
														</div>
													</div>
												</div>
											</form>
										</div>
									<?php } else { ?>
										<div class="form_title"><?php echo $diccionario->buttons->expert->$_SESSION['lang'] ?></div>
										<div class="form">
											<form name="consulta2" novalidate>
												<input ng-model="short.name" type="text" name="name2" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
												<div ng-show="consulta2.name2.$touched && !consulta2.$pristine">
													<span ng-show="consulta2.name2.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?></span>
												</div>
												<input ng-model="short.email" type="email" name="email2" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>" required>
												<div ng-show="consulta2.email2.$touched && !consulta2.$pristine">
													<span ng-show="consulta2.email2.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
													<span ng-show="consulta2.email2.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
												</div>
												<textarea ng-model="short.txt" name="txt2" rows="4" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>" required></textarea>
												<div ng-show="consulta2.txt2.$touched && !consulta2.$pristine">
													<span ng-show="consulta2.txt2.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
												</div>
												<span class="form_check"><input ng-model="short.politica" type="checkbox" name="politica2" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
												<input class="boton" type="submit" ng-click="sendMailConsultaDos()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!consulta2.$valid">
											</form>
										</div>
									<?php }  ?>
								</div>
							</div>
							<?php } ?>
						</div>
						<div class="col-xs-12">
							<div class="controls_form">
								<span ng-repeat="n in [] | range:contenido.sliders.slider.length">
									<span ng-show="sliderSelected(n)"><img src="/img/selected.png"></span>
									<span ng-hide="sliderSelected(n)"><a href="" ng-click="changeSlider($index)"><img src="/img/deselected.png"></a></span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php 
				$sliders = $xml_code->sliders->slider;
				if (count($sliders) > 0) {
					for ($i=0; $i<count($sliders); $i++) {
						if (isset($sliders[$i]->title->$_SESSION['lang'])) {
							echo '
							<div ng-show="sliderSelected('.$i.')">
								<div class="slider_title">'.traducirStringXml($sliders[$i]->title->$_SESSION['lang']).'</div>
							</div>
							';
						}
					}
				} else {
					if (isset($sliders->title->$_SESSION['lang'])) {
						echo '
						<div class="slider_title">'.traducirStringXml($sliders->title->$_SESSION['lang']).'</div>
						';
					}
				}
				?>
				<!-- <div class="slider_control"></div>
				<div class="slider_title">tu salud en las mejores manos</div> -->
			</div>
		<?php } ?>