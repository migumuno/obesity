<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
switch ($_SESSION['lang']) {
	case "en":
		$msg_title = 'Notification';
		$login = '';
		break;
	case "de":
		$msg_title = 'Notification';
		break;
	default:
		$login = 'El usuario y/o la contraseña no son correctos';
		$msg_title = 'Notificación / Notification';
}
?>
<!DOCTYPE html>
<html class="app" ng-app="app">
<head>  
  <meta charset="utf-8" />
  <title>EMIO | Área Pacientes</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
  <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular-route.min.js'></script>
  <?php 
  if ($_SESSION['lang'] == 'en')
  	echo '<script src="https://code.angularjs.org/1.2.19/i18n/angular-locale_en-us.js"></script>';
  else if($_SESSION['lang'] == 'de')
  	echo '<script src="https://code.angularjs.org/1.2.19/i18n/angular-locale_de-de.js "></script>';
  else
  	echo '<script src="https://code.angularjs.org/1.2.19/i18n/angular-locale_es-es.js"></script>';
  ?>
    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
  <!-- content -->
  
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xl">
      <a class="navbar-brand block" href="/"><img title="european medical institute of obesity" alt="european medical institute of obesity" src="https://www.obesity.es/img/logo_emio.png"></a>
      <br>
      <section class="m-b-lg">
      	<?php if (isset($_GET['msg'])) { ?>
	      	<div class="alert alert-warning alert-block">
				<button class="close" data-dismiss="alert" type="button">×</button>
				<h4><?php echo $msg_title ?></h4>
				<?php
				$msg = array();
				switch ($_GET['msg']) {
					case "login":
						$msg['es'] = 'El usuario y/o la contraseña no son correctos.<br>The username and/or password are incorrect.';
						$msg['en'] = 'The username and/or password are incorrect.';
						$msg['de'] = 'The username and/or password are incorrect.';
						break;
					case "changePass":
						$msg['es'] = 'Le hemos enviado un email para que pueda cambiar su contraseña.<br>We have sent you an email so you can change your password.';
						$msg['en'] = 'We have sent you an email so you can change your password.';
						$msg['de'] = 'We have sent you an email so you can change your password.';
						break;
					case "errorChange":
						$msg['es'] = 'El usuario introducido no es correcto o no hemos podido enviarle un email, si el problema persiste póngase en contacto con nosotros a través de patients@obesity.es.<br>The username is incorrect or we have been unable to send you an email. If the problem persists, please contact us through patients@obesity.es.';
						$msg['en'] = 'The username is incorrect or we have been unable to send you an email. If the problem persists, please contact us through patients@obesity.es.';
						$msg['de'] = 'The username is incorrect or we have been unable to send you an email. If the problem persists, please contact us through patients@obesity.es.';
						break;
					case "activate":
						$msg['es'] = 'Todo listo! Ahora puede entrar con su nueva contraseña.<br>Everything is ready! Now you can login with your new password.';
						$msg['en'] = 'Everything is ready! Now you can login with your new password.';
						$msg['de'] = 'Everything is ready! Now you can login with your new password.';
						break;
					case "errorActivate":
						$msg['es'] = "No hemos podido activar su cuenta, asegúrese de introducir correctamente sus datos. Si el problema persiste póngase en contacto con nosotros a través de patients@obesity.es.<br>We haven't been able to activate your account. Make sure to fill in the details correctly. If the problem persists please contact us through patients@obesity.es";
						$msg['en'] = "We haven't been able to activate your account. Make sure to fill in the details correctly. If the problem persists please contact us through patients@obesity.es";
						$msg['de'] = "We haven't been able to activate your account. Make sure to fill in the details correctly. If the problem persists please contact us through patients@obesity.es";
						break;
				}
				?>
				<p><?php echo $msg[$_SESSION['lang']] ?></p>
			</div>
		<?php } ?>
  	  	<div ng-view></div>
      </section>
    </div>
  </section>
  <!-- / content -->

  <!-- footer -->  
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>european medical institute of obesity</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/app.plugin.js"></script>
  <!-- AngularJS -->
  
  <script type="text/javascript">
  /**
   * Declaración del módulo de AngularJS, le incluye ngRoute para poder usar rutas
  **/
  var app = angular.module("app", ['ngRoute']);
  app.value('idioma', '<?php echo $_SESSION['lang'] ?>');
  <?php if (isset($_GET['key'])) { ?>
  app.value('clave', '<?php echo $_GET['key'] ?>');
  <?php } else { ?>
  app.value('clave', '');
  <?php } ?>
  </script>
  <script src="js/access.js"></script>
</body>
</html>