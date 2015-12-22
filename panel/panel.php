<?php
include $_SERVER['DOCUMENT_ROOT'].'/main.php';
$tipo = $_SESSION['user']['type'];
?>
<!DOCTYPE html>
<html lang="es" class="app" ng-app="app" ng-controller="PanelController as panel">
<head>  
  <meta charset="utf-8" />
  <title>EMIO | Área Paciente</title>
  <meta name="description" content="obesity area paciente" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/css/icon.css" type="text/css" />
  <link rel="stylesheet" href="/css/font.css" type="text/css" />
  <link rel="stylesheet" href="/css/app.css" type="text/css" />
  <link rel="stylesheet" href="/css/panel.css" type="text/css" />
  <link rel="stylesheet" href="/js/fullcalendar/fullcalendar.css" type="text/css" />
  <link rel="stylesheet" href="/js/fullcalendar/theme.css" type="text/css" />
  <link rel="stylesheet" href="/js/calendar/bootstrap_calendar.css" type="text/css" />
  <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body class="">
<em-notifcreate></em-notifcreate>
<em-notifedit></em-notifedit>
<em-notiferase></em-notiferase>
<em-notifmessage></em-notifmessage>
<em-confirm></em-confirm>
<em-errormessage></em-errormessage>
<em-errorgeneral></em-errorgeneral>
<em-errorpass></em-errorpass>
<em-notiffile></em-notiffile>
<em-infoadmin></em-infoadmin>
<em-infopatient></em-infopatient>
<em-changepass></em-changepass>
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header dk">
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target="#menu_panel">
          <i class="i i-grid"></i>
        </a>
        <a href="#dashboard" class="navbar-brand">
          <img src="images/logo_emio.png" class="m-r-sm" alt="scale">
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
        <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs visible-xs" role="search">
	        <div class="form-group">
	          <div class="input-group">
	            <span class="input-group-btn">
	              <button type="submit" class="btn btn-sm bg-white b-white btn-icon"><i class="fa fa-search"></i></button>
	            </span>
	            <input type="text" class="form-control input-sm no-border" placeholder="{{dictionary.menu.search[lang]}}" list="patients_list" autocomplete="off"> 
	            <datalist id="patients_list">
					<option value="{{$index}}" ng-repeat="name in people">{{name.nombre}}</option>
				</datalist>          
	          </div>
	        </div>
	      </form>
      </div>
      <ul class="nav navbar-nav">
        <li class="dropdown" id="menu_panel">
          <a class="btn btn-link dropdown-toggle hidden-xs" data-toggle="dropdown">
            <i class="i i-grid"></i>
          </a>
          <section class="dropdown-menu aside-lg bg-white on animated fadeInLeft">
            <div class="row m-l-none m-r-none m-t m-b text-center">
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#dashboard">
                    <span class="m-b-xs block">
                      <i class="i i-statistics i-2x text-info-lt"></i>
                    </span>
                    <small class="text-muted">{{dictionary.menu.dashboard[lang]}}</small>
                  </a>
                </div>
              </div>
              <div ng-if="user.type != 2" class="col-xs-4">
                <div class="padder-v">
                  <a href="#messages">
                    <span class="m-b-xs block">
                      <i class="i i-mail i-2x text-primary-lt"></i>
                    </span>
                    <small class="text-muted">{{dictionary.menu.messages[lang]}}</small>
                  </a>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="padder-v">
                  <a href="#calendar">
                    <span class="m-b-xs block">
                      <i class="i i-calendar i-2x text-danger-lt"></i>
                    </span>
                    <small class="text-muted">{{dictionary.menu.calendar[lang]}}</small>
                  </a>
                </div>
              </div>
              <div ng-if="user.type != 0" class="col-xs-4">
                <div class="padder-v">
                  <a href="#chat">
                    <span class="m-b-xs block">
                      <i class="i i-chat i-2x text-warning-lter"></i>
                    </span>
                    <small class="text-muted">{{dictionary.menu.chat[lang]}}</small>
                  </a>
                </div>
              </div>
            </div>
          </section>
        </li>
      </ul>
      <span  ng-if="user.type != 0">
	      <form action="#patient" method="post" name="search_patient" class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
	        <div class="form-group fill_all">
	          <div class="input-group">
	            <span class="input-group-btn">
	              <button type="submit" ng-disabled="!search_patient.$valid" class="btn btn-sm bg-white b-white btn-icon"><i class="fa fa-search"></i></button>
	            </span>
	            <input type="text" ng-change="setPatient()" ng-model="search.aux" class="form-control input-sm no-border" placeholder="{{dictionary.menu.search[lang]}}" required list="patients_list" autocomplete="off">
	            <span class="input-group-btn">
	              <button type="submit" ng-if="search_patient.$valid" class="btn btn-sm btn-default">Buscar</button>
	            </span>
	            <input type="hidden" name="patient" value="{{search.to}}">
	            <datalist id="patients_list">
					<option value="{{$index}}" ng-repeat="name in people">{{name.nombre}}</option>
				</datalist>           
	          </div>
	        </div>
	      </form>
	  </span>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
        <li class="dropdown">
          <a class="dropdown-toggle btn" data-toggle="dropdown">
            <!-- <span class="thumb-sm avatar pull-left">
              <img src="images/a0.png" alt="...">
            </span> -->
            {{user.name}} <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <li>
              <a class="btn text-left" ng-click='showChangePass()'>{{dictionary.texts.change_pass[lang]}}</a>
            </li>
            <li ng-if="user.type==0">
              <a class="btn text-left" ng-click='showInfo()'>{{dictionary.texts.edit_info[lang]}}</a>
            </li>
            <!-- <li>
            	<a class="btn inline"><img src="https://www.obesity.es/img/es.png"></a>
            	<a class="btn inline"><img src="https://www.obesity.es/img/en.png"></a>
            	<a class="btn inline"><img src="https://www.obesity.es/img/de.png"></a>
            </li> -->
            <li class="divider"></li>
            <li>
              <a href="?action=logout">{{dictionary.menu.logout[lang]}}</a>
            </li>
          </ul>
        </li>
      </ul>      
    </header>
    <section>
      <section class="hbox stretch" ng-view id="controller">
                	
		<!-- CONTENIDO -->
                
      </section>
    </section>
  </section>
  <script src="/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/js/bootstrap.js"></script>
  <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap-datetimepicker.es.js"></script>
  <!-- AngularJs -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
  <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular-route.min.js'></script>
  
  <span ng-if="lang == 'es'"><script src="/js/angular-locale_es-es.js"></script></span>
  <span ng-if="lang == 'en'"><script src="/js/angular-locale_en-us.js"></script></span>
  <span ng-if="lang == 'de'"><script src="/js/angular-locale_de-de.js"></script></span>
  <!-- App -->
  <script src="/js/app.js"></script>  
  <script src="/js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="/js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="/js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="/js/charts/flot/jquery.flot.min.js"></script>
  <script src="/js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="/js/charts/flot/jquery.flot.spline.js"></script>
  <script src="/js/charts/flot/jquery.flot.pie.min.js"></script>
  <script src="/js/charts/flot/jquery.flot.resize.js"></script>
  <script src="/js/charts/flot/jquery.flot.grow.js"></script>
  <script src="/js/charts/flot/demo.js"></script>

  <script src="/js/sortable/jquery.sortable.js"></script>
  <script src="/js/app.plugin.js"></script>
  <!-- CÓDIGO ANGULARJS -->
  <!-- AngularJS -->
  
  <!-- Declaración del módulo de AngularJS, incluyo ngRoute para poder usar rutas -->
  <script>var app = angular.module("app", ['ngRoute']);</script>
  
  <!-- Incluyo las funciones específicas de angularjs -->
  <script src="/js/functions-angular.js"></script>
  
  <!-- Añado los providers -->
  <script>
  	app.provider("remoteResource", RemoteResourceProvider);
  	app.config(['remoteResourceProvider', function(remoteResourceProvider){
  		remoteResourceProvider.setType('<?php echo $_SESSION['user']['type'] ?>');
  	}]);
  </script>
  
  <!-- Incluyo lo configuración del módulo -->
  <script src="/js/config-angular.js"></script>
  
  <!-- Incluyo las factorias -->
  <script src="/js/factories-angular.js"></script>
  
  <!-- Incluyo las directivas -->
  <script src="/js/directives-angular.js"></script>
  
  <!-- Declaro los valores que necesitan de PHP -->
  <script>
  app.value('idioma', '<?php echo $_SESSION['lang'] ?>');
  app.value('paciente', '<?php echo $_POST['patient'] ?>');
  app.value('user', {
		name: '<?php echo $_SESSION['user']['name'] ?>'
		,email: '<?php echo $_SESSION['user']['email'] ?>'
		,type: '<?php echo $_SESSION['user']['type'] ?>'
  });
  </script>
  
  <!-- Incluyo los controladores -->
  <script src="/js/panel.js"></script>
  <!-- FIN CÓDIGO ANGULARJS -->
</body>
</html>