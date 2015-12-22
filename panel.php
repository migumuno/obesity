<?php 
include_once 'Libraries/ckfinder/ckfinder.php';
//Obtengo la info de la empresa
$enum = "info_company";
$controller = $_SESSION['SO']->getController();
$controller->setEnum($enum);
$info = $controller->select();
?>
<!doctype html>
<html class="no-js" lang="es" ng-app="panel" ng-controller="OfferController">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $program->getInfo('title'); ?></title>
    <meta name="description" content="<?php echo $program->getInfo('description'); ?>">
	<meta name="keywords" content="<?php echo $program->getInfo('keywords'); ?>">
	<meta name="author" content="Miguel Ángel Muñoz Viejo">
	<link rel="shortcut icon" href="<?php echo $program->getDir() ?>img/favicon.ico">
	<link rel="icon" href="<?php echo $program->getDir() ?>img/favicon.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $program->getDir() ?>img/apple.png">
	<link href="<?php echo $program->getDir(); ?>img/logo.jpg" rel="image_src">
    <link rel="stylesheet" href="Libraries/foundation/css/foundation.css" />
    <link rel="stylesheet" href="Libraries/foundation/css/normalize.css" />
    <link rel="stylesheet" href="<?php echo $program->getDir(); ?>css/app.css" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <script src="Libraries/foundation/js/vendor/modernizr.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="Libraries/jquery-ui/jquery-ui.css " />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script type="text/javascript" src="Libraries/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="Libraries/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="Libraries/AngularJs/angular.min.js"></script>
	<script type="text/javascript" src="<?php echo $program->getDir(); ?>js/panel.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBvb5rGbk9ELMY_XYKViUIW-QyKnJluvu0&sensor=false"></script>
	<!-- Jquery File Upload -->
	<link rel="stylesheet" href="Libraries/jQuery-File-Upload-master/css/style.css">
	<script>
	function openMenu () {
		$('.off-canvas-wrap').foundation('offcanvas', 'show', 'move-right');
	}
	function closeMenu () {
		$('.off-canvas-wrap').foundation('offcanvas', 'hide', 'move-right');
	}
	$(document).ready(function () {
		<?php
		if (SO::$ALERT) {
			echo '
			$( "#msg" ).html(\'<div class = "small-10 small-offset-1 columns">\');
			$( "#msg" ).append(\'<div class = "row"><h4>'.SO::$MESSAGE.'</h4></div>\');
			$( "#msg" ).append(\'<div class = "large-4 large-offset-4 medium-6 medium-offset-3 small-10 small-offset-1 columns text-center"><a id = "close_msg" href = "#"><img src = "'.$program->getDir().'img/bar-iPhone.png"></a></div>\');
			$( "#msg" ).append(\'</div>\');
			$( "#msg" ).fadeIn( "slow");
			$( "#close_msg" ).click(function() {
			  $( "#msg" ).fadeOut( "slow", function() {
				  $( "#msg" ).html(\'\');
				  $( "#msg" ).append(\'<img src = "'.$program->getDir().'img/bar-iPhone.png">\');
			  });
			});
			';
		}
		?>
		var fecha = new Date();
		var anno = fecha.getFullYear() + 1;
		var height = $( window ).height() - 185;
		$(".main-section").css('min-height', height);
		$("#dp1").datepicker({
			dateFormat: 'yy/mm/dd',
			changeYear: true,
			yearRange: "1900:"+anno,
			changeMonth: true
		});
		$("#dp2").datepicker({
			dateFormat: 'yy/mm/dd',
			changeYear: true,
			yearRange: "1900:"+anno,
			changeMonth: true
		});
		$("#birthday").datepicker({
			dateFormat: 'yy/mm/dd',
			changeYear: true,
			yearRange: "1900:"+anno,
			changeMonth: true
		});
		$('#domain').change(function(){
			
	        $('#domain_error').html('<img src="Programs/Web/img/loader.gif" alt="" width = "20px" />').fadeOut(1000);
	
	        var domain = $(this).val();
	
	        $.ajax({
	            type: "POST",
	            url: "ajaxRequests.php",
	            data: {domain: domain, action : 'domain'},
	            success: function(data) {
	                $('#domain_error').fadeIn(1).html(data);
	            }
	        });
	    }); 
	});
	</script>
	<!-- Google Maps -->
	<script type="text/javascript">
		function initialize(lat, lng){
			var mapProp = {
			  center:new google.maps.LatLng(lat, lng),
			  zoom:9,
			  mapTypeId:google.maps.MapTypeId.TERRAIN
			  };
		
			var map=new google.maps.Map(document.getElementById("mapa")
			  ,mapProp);
			  
			var marcador = new google.maps.Marker({
			 	position: new google.maps.LatLng(lat, lng),
			  	map: map
			});
	
		}
		
		$(document).ready(function() { 
			$('.button.google').click(function(){

		    	var direction = document.getElementById("location").value;
		    	var latitude = '';
		    	var longitude = '';
				$('#mapa').height(300);
					
				$.ajax({
		            type: "POST",
		            url: "ajaxRequests.php",
		            data: {direction: direction, action : 'latlng'},
		            success: function(data) {
		                var array = data.split(',');
		                initialize(array[0], array[1]);
		            }
		        });
		    });              
		});    
	</script>
	<!-- Image Picker -->
	<!-- CSS -->
	<link rel="stylesheet" href="Libraries/ImagePicker/imgPicker/assets/css/imgpicker.css">
	
	<!-- JavaScript -->
	<script src="Libraries/ImagePicker/imgPicker/assets/js/jquery.Jcrop.min.js"></script>
	<script src="Libraries/ImagePicker/imgPicker/assets/js/jquery.imgpicker.js"></script>
  </head>
  <body>
  	<div id = "msg">
  		
  	</div>
	
  	<div id = "cabecera">
  		<div class="off-canvas-wrap" data-offcanvas>
  					<div class="inner-wrap">
  						<div class = "row">
	  						<div class = "large-10 large-offset-1 columns">
	  							<div class = "small-8 columns">
	  								<h1><a href = "?program=company"><img src = "<?php echo $program->getDir() ?>img/logo.png" width = "50" alt = "logo jobteep"> JobTeep</a></h1>
	  							</div>
	  							<div class = "small-4 columns">
	  								<div class = "visualizar text-right"><a href="?action=companylogout"><img alt = "jobteep" src = "<?php echo $program->getDir() . "/img/erase.png" ?>" width = "30px"></a></div>
	  							</div>
	  						</div>
	  					</div>
	  					<aside class="left-off-canvas-menu">
	  						  <h1 class = "text-center"><img src = "<?php echo $program->getDir() ?>img/logo.png" width = "50" alt = "logo jobteep"> JobTeep <a class="left-off-canvas-toggle" href="#"><img src = "<?php echo $program->getDir() . "/img/menu_black.png" ?>" width = "40px"></a></h1>
					    	  <ul class="off-canvas-list">
								<li><a href="?action=companylogout"><span><img alt = "jobteep" src = "<?php echo $program->getDir() . "/img/erase.png" ?>" width = "30px"></span>&nbsp;&nbsp; Salir</a></li>
						      </ul>
					    </aside>
					    <section class="main-section">
					      	<div class = "row">
						  		<div class = "large-12 columns">
						  			<?php 
							    		include $program->getDir() . $program->getInfo('content');
							    	?>
					  		</div>
					    </div>
				    </section>
				    <a class="exit-off-canvas"></a>
  				</div>
  			</div>
	</div>
	<div id = "pie_pagina">
		<div class = "row">
	  		<div class = "large-10 large-offset-1 columns">
  				<div class = "row">
		  			<div class = "large-12 columns">
		  				<div class = "large-6 columns">
		  					<small>JobTeep &copy; Todos los derechos reservados.</small>
		  				</div>
		  				<div class = "large-6 columns">
		  					<ul>
		  						<li><small>Política de privacidad</small></li>
		  						<li><small>Ley de Cookies</small></li>
		  						<li><small>Contacto</small></li>
		  					</ul>
		  				</div>
		  			</div>
		  		</div>
	  		</div>
  		</div>
	</div>
  	
  	<!-- Avatar Modal -->
	<div class="ip-modal" id="avatarModal">
		<div class="ip-modal-dialog">
			<div class="ip-modal-content">
				<div class="ip-modal-header">
					<a class="ip-close" title="Close">&times;</a>
					<h4 class="ip-modal-title">Cambiar Avatar</h4>
				</div>
				<div class="ip-modal-body">
					<div class="btn btn-primary ip-upload">Subir <input type="file" name="file" class="ip-file"></div>
					<button class="btn btn-primary ip-webcam">Webcam</button>
					<button type="button" class="btn btn-info ip-edit">Editar</button>
					<button type="button" class="btn btn-danger ip-delete">Eliminar</button>
					
					<div class="alert ip-alert"></div>
					<div class="ip-info">To crop this image, drag a region below and then click "Save Image"</div>
					<div class="ip-preview"></div>
					<div class="ip-rotate">
						<button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
						<button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i class="icon-cw"></i></button>
					</div>
					<div class="ip-progress">
						<div class="text">Subiendo</div>
						<div class="progress progress-striped active"><div class="progress-bar"></div></div>
					</div>
				</div>
				<div class="ip-modal-footer">
					<div class="ip-actions">
						<button class="btn btn-success ip-save">Retocado</button>
						<button class="btn btn-primary ip-capture">Capturar</button>
						<button class="btn btn-success ip-cancel">Original</button>
					</div>
					<button class="btn btn-default ip-close">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end Modal -->
	
    <script src="Libraries/foundation/js/vendor/fastclick.js"></script>
    <script src="Libraries/foundation/js/foundation.min.js"></script>
  	<script src="Libraries/foundation/js/foundation/foundation.joyride.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script> 
		$(function() {
			var time = function(){return'?'+new Date().getTime()};
			
			// Avatar setup
			$('#avatarModal').imgPicker({
				url: 'Libraries/ImagePicker/imgPicker/server/upload_avatar_company.php',
				aspectRatio: 1, // Crop aspect ratio
				// Delete callback
				deleteComplete: function() {
					$('#avatar').attr('src', '<?php echo $program->getDir() ?>img/profile.png');
					$('#perfil').attr('value', '');
					this.modal('hide');
				},
				// Crop success callback
				cropSuccess: function(image) {
					console.log(image);
					$('#avatar').attr('src', image.versions.avatar.url + time());
					$('#perfil').attr('value', image.versions.avatar.name);
					/*this.modal('hide');*/
				},
				uploadSuccess: function(image) {
					console.log(image);
					$('#avatar').attr('src', image.versions.avatar.url + time());
					$('#perfil').attr('value', image.versions.avatar.name);
					this.modal('hide');
				},
				// Send some custom data to server
				data: {
					k: 'value',
				}
			});
		}); 
	</script>
	<!-- CKEDITOR -->
	<script type="text/javascript">
		var ck_description = CKEDITOR.replace( 'ck_description' );
		var ck_description2 = CKEDITOR.replace( 'ck_description2' );
		var ck_description3 = CKEDITOR.replace( 'ck_description3' );
	    var ck_short_description = CKEDITOR.replace( 'ck_short_description' );
	    
		CKFinder.setupCKEditor( ck_description, 'Libraries/ckfinder/' );
	</script>
	
	<!-- ANGULARJS -->
	<script>
	var app = angular.module('panel',[]);

	app.controller('OfferController', ['$scope','$http', function($scope, $http) {
	  $scope.getCandidates = function() {
		$http.post("ajaxRequests.php?action=getCandidates&type=selected&offer=<?php echo $_GET['id'] ?>")
			.success(function(res){
				$scope.candidatesSelected = res;
				console.log(res);
			});
		$http.post("ajaxRequests.php?action=getCandidates&offer=<?php echo $_GET['id'] ?>")
			.success(function(res){
				$scope.candidates = res;
				console.log(res);
			});
	  }
	  $scope.seleccionar = function(pag, id, c) {
		  console.log(c);
		  selectCandidate(pag,id,c);
	  }
	  $scope.quitar = function(pag, id, c) {
		  console.log(c);
		  eraseCandidate(pag,id,c);
	  }
	  $scope.filtrosShow = false;
	  $scope.tiposFiltros = [
	        {name: "Habilidades", id: 1}
	        ,{name: "Idiomas", id: 2}
	  ];
	  $scope.niveles = [
			{name: "Aprendiz", id: 0}
			,{name: "Junior", id: 1}
			,{name: "Especialista", id: 2}
			,{name: "Maestro", id: 3}
			,{name: "Gurú", id: 4}
		];
	  $scope.nivelesIdiomas = [
        	{name: "Todos", id: 5}
        	,{name: "A2", id: 0}
        	,{name: "B1", id: 1}
        	,{name: "B2", id: 2}
        	,{name: "C1", id: 3}
        	,{name: "C2", id: 4}
        ];
	  $scope.filtros = [];
	  $scope.addFiltro = function() {
		  $scope.filtros.push({type:$scope.filtro.type.name, name:$scope.filtro.nameFilter, level:$scope.filtro.level.name, id_level:$scope.filtro.level.id});
		  $scope.filtro = "";
	  }
	  $scope.getFilters = function() {
		  $scope.skill = [];
		  $scope.language = [];
		  for (var f=0; f < $scope.filtros.length; f++) {
			  if ($scope.filtros[f].type == "Habilidades")
				  $scope.skill.push({name:$scope.filtros[f].name, level:$scope.filtros[f].id_level});
			  else if ($scope.filtros[f].type == "Idiomas")
				  $scope.language.push({name:$scope.filtros[f].name, level:$scope.filtros[f].id_level});
		  }
	  }
	  $scope.aplyFilters = function() {
		$scope.getFilters();
		where = '';
		if ($scope.skill.length != undefined && $scope.skill.length > 0) {
			for (var i = 0; i < $scope.skill.length; i++) {
				where = where + ' AND id_user IN (SELECT id_user FROM skill WHERE name = "'+$scope.skill[i].name+'" AND level >= '+$scope.skill[i].level+')';
			}
		}
		if ($scope.language.length != undefined && $scope.language.length > 0) {
			for (var i = 0; i < $scope.language.length; i++) {
				where = where + ' AND id_user IN (SELECT id_user FROM language WHERE name = "'+$scope.language[i].name+'" AND level >= '+$scope.language[i].level+')';
			}
		}
		console.log(where);
		$http.post("ajaxRequests.php?action=getCandidates&type=filter&where="+where+"&offer=<?php echo $_GET['id'] ?>")
		.success(function(res){
			$scope.candidates = res;
			console.log(res);
		});
	  }
	}]);
	</script>
  </body>
</html>
