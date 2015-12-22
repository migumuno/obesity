<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-md-15 col-sm-4 col-xs-12 item_footer_logo">
							<ul>
								<li><img title="<?php echo $pie->img->logo_footer->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->logo_footer->alt->$_SESSION['lang'] ?>" src="/img/<?php echo $pie->img->logo_footer->link ?>"></li>
								<li>
									<span class="row">
										<span class="col-xs-2"><img alt="dirección" src="/img/icons/pin.png"></span>
										<span class="col-xs-10">Paseo de la Habana, 63 28036 Madrid</span>
									</span>
								</li>
								<li>
									<span class="row">
										<span class="col-xs-2"><img title="<?php echo $pie->img->phone->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->phone->alt->$_SESSION['lang'] ?>" src="/img/icons/<?php echo $pie->img->phone->link ?>"></span>
										<span class="col-xs-10"><a href="tel:+34900104050" target="_blank">+34 900 10 40 50</a><br></span>
									</span>
								</li>
								<!-- <li>
									<span class="row">
										<span class="col-xs-2"><img alt="skype" src="/img/icons/skype.png"></span>
										<span class="col-xs-10"><a href="#">obesity.es</a><br></span>
									</span>
								</li> -->
								<li>
									<span class="row">
										<span class="col-xs-2"><img title="<?php echo $pie->img->mail->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->mail->alt->$_SESSION['lang'] ?>" src="/img/icons/<?php echo $pie->img->mail->link ?>"></span>
										<span class="col-xs-10"><a href="mailto:info@obesity.es">info@obesity.es</a></span>
									</span>
								</li>
								<!-- <li>SIGUENOS EN: <img alt="facebook" src="/img/icons/facebook_footer.png"> <img alt="twitter" src="/img/icons/twitter_footer.png"> <img alt="blog" src="/img/icons/blog_footer.png"> <img alt="youtube" src="/img/icons/youtube_footer.png"></li> -->
							</ul>
						</div>
						<?php 
						for ($i=0; $i<count($pie->section); $i++) {
							echo '
							<div class="col-md-15 col-sm-4 col-xs-12 item_footer">
								<div class="titulo titulo_footer">'.$pie->section[$i]->title->$_SESSION['lang'].'</div>
								<ul>';
									$items = $pie->section[$i]->items->item;
									if (count($items) > 0) {
										for ($h=0; $h<count($items); $h++) {
											echo '<li><a href="/'.$_SESSION['lang'].$items[$h]->link->$_SESSION['lang'].'">'.$items[$h]->name->$_SESSION['lang'].'</a></li>';
										}
									} else {
										echo '<li><a href="/'.$_SESSION['lang'].$items->link->$_SESSION['lang'].'">'.$items->name->$_SESSION['lang'].'</a></li>';
									}
								echo '</ul>
							</div>
							';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="creditos">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-md-6 col-xs-12">
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[0]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[0]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[0]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[1]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[1]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[1]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[2]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[2]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[2]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[3]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[3]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[3]->img; ?>" width="100%"></div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[4]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[4]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[4]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[5]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[5]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[5]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[6]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[6]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[6]->img; ?>" width="100%"></div>
							<div class="col-sm-3 col-xs-6"><img title="<?php echo $creditos->item[7]->alt->$_SESSION['lang']; ?>" alt="<?php echo $creditos->item[7]->alt->$_SESSION['lang']; ?>" src="/img/<?php echo $creditos->item[7]->img; ?>" width="100%"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="legal">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-xs-12">
							&#169; european medical institute of obesity
						</div>
						<div class="col-xs-12 legal_right">
							<ul>
								<li class="legal_li"><a href="/<?php echo $_SESSION['lang'] ?>/legal"><?php echo $diccionario->texts->legal->$_SESSION['lang'] ?></a></li>
								<li class="legal_li"><a href="/<?php echo $_SESSION['lang'] ?>/legal"><?php echo $diccionario->texts->privacity->$_SESSION['lang'] ?></a></li>
								<li class="legal_li"><a href="/<?php echo $_SESSION['lang'] ?>/legal"><?php echo $diccionario->texts->cookies->$_SESSION['lang'] ?></a></li>
								<li class="legal_last"><a href="/livechat/php/app.php?login"><img src="/img/icons/panel.png" width="18"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="go-top" href="#"><img src="/img/subir.png" alt="subir" width="50"></a>
	</div>
	<script>
    $(document).ready(function() {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 200)
				$('.go-top').fadeIn(200);
			else
				$('.go-top').fadeOut(200);
		});
		$('.go-top').click(function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 300);
		});
	});
	</script>
	
	<!-- Angular -->
	<script>
	
	/**
	* Creación de la App
	**/
	var app = angular.module('web', []);
	/**
	* Filtro que crea un rango para un ng-repeat
	* range: número entero
	**/
	app.filter('range', function() {
	  return function(input, total) {
	    total = parseInt(total);
	    for (var i=0; i<total; i++)
	      input.push(i);
	    return input;
	  };
	});
	/**
	* Controlador de la aplicación
	*/
	app.controller('PageController', function($scope, $sce, $http, $interval, $filter) {
	    /**
		* Variables iniciales
		**/
	    $scope.lang = "<?php echo $_SESSION['lang'] ?>";
	    $scope.limitChars = 200;
	    $scope.slider = 0;
	    $scope.time = 8000;
      	$scope.form=1;
      	$scope.llamamos = false;
    	$scope.short = {};
    	$scope.long = {};
    	$scope.call = {};


	    
		/**
		* Obtiene el contenido de la página y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=<?php echo $xml ?>.xml').
	    	success(function(response) {
	    		$scope.contenido = response;
	    		console.log(response);
	    		if (response.sliders.slider.length != undefined)
	    	    	document.getElementById("slider").style.backgroundImage = "url('/img/"+response.sliders.slider[0].img+"')";
	    		else
	    			document.getElementById("slider").style.backgroundImage = "url('/img/"+response.sliders.slider.img+"')";
	    	});
	    /**
		* Obtiene las imágenes de la página y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=img.xml').
	    	success(function(response) {
	    		$scope.images = response;
	    		console.log(response);
	    	});
	    /**
		* Obtiene el contenido de los 3 últimos posts del blog y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=last_posts&lang='+$scope.lang).
	    	success(function(response) {
	    		$scope.wp_posts = response;
	    	});
	    /**
		* Obtiene el diccionario de textos y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=dictionary.xml').
	    	success(function(response) {
	    		$scope.dictionary = response;
	    	});
	    /**
		* Obtiene los paises y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=countries.xml').
	    	success(function(response) {
	    		$scope.countries = response;
	    	});
	    /**
		* Obtiene el menú y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=menu.xml').
	    	success(function(response) {
	    		$scope.menu = response;
	    	});
	    /**
		* Obtiene el menú del footer y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=footer.xml').
	    	success(function(response) {
	    		$scope.footer = response;
	    	});
	    /**
		* Obtiene los créditos y lo guarda en el $scope
		**/
	    $http.get('/json.php?query=xml&xml=creditos.xml').
	    	success(function(response) {
	    		$scope.creditos = response;
	    	});


    	
	    /**
		* Funcíon que cambia el idioma
		**/
	    $scope.setLang = function(lang) {
	    	$scope.lang = lang;
	    }

	    /**
		* Limita un string
		* @param str String
		* @param limit Int
		**/
	    $scope.limitar = function(str, limit) {
			return $filter('limitTo')(str,limit);
	    }
	    /**
		* Función que define si value es un array
		* @param value Void
		**/
	    $scope.esArray = function(value) {
		    return angular.isArray(value);
	    }
	    /**
		* Función que interpreta caracteres del xml convirténdolos en tags HTML
		* @param str String
		**/
		$scope.interpretar = function(str) {
			var newStr = str.split('-#').join('>');
			newStr = newStr.split('#').join('<');
			return $sce.trustAsHtml(newStr);
		}
		/**
		* Función que aplica un filtro de limitación de caracteres
		* @param str String
		**/
		$scope.intercortar = function(str) {
			var newStr = $filter('limitTo')(str,$scope.limitChars,0) + '...';
			newStr = $sce.trustAsHtml(newStr);
			return newStr;
		}
		/**
		* Función que comprueba si el slider pasado es el seleccionado
		* @param slider Int
		**/
	    $scope.sliderSelected = function(slider){
	    	return $scope.slider === slider;
	    }
		/**
		* Función que cambia el slider seleccionado
		* @param slider Int
		**/
	    $scope.changeSlider = function(slider) {
		    if ($scope.contenido.sliders.slider.length != undefined)
	    		document.getElementById("slider").style.backgroundImage = "url('/img/"+$scope.contenido.sliders.slider[slider].img+"')";
	    	$scope.slider = slider;
	    }
		/**
		* Temporizador que cambia las slides
		**/
	    var timer=$interval(function(){
		    if ($scope.contenido.sliders.slider.length != undefined) {
		    	if($scope.slider == $scope.contenido.sliders.slider.length-1) {
		    		$scope.slider = 0;
			    	document.getElementById("slider").style.backgroundImage = "url('/img/"+$scope.contenido.sliders.slider[$scope.slider].img+"')";
		    	} else {
	        		$scope.slider = $scope.slider+1;
			    	document.getElementById("slider").style.backgroundImage = "url('/img/"+$scope.contenido.sliders.slider[$scope.slider].img+"')";
		    	}
		    } else
		    	document.getElementById("slider").style.backgroundImage = "url('/img/"+$scope.contenido.sliders.slider.img+"')";
      	},$scope.time);
		/**
		* Función indica si el formulario pasado es el seleccionado
		* @param form Int
		**/
      	$scope.formSelected = function(form) {
			return $scope.form === form;
      	}
		/**
		* Función que cambia el form seleccionado
		* @param form Int
		**/
      	$scope.changeForm = function(form) {
          	$scope.form = form;
      	}
		/**
		* Función que cambia el estado de llamamos (formulario de contacto del menú)
		* @param form Int
		**/
      	$scope.changeLlamamos = function() {
          	if ($scope.llamamos) $scope.llamamos = false;
          	else $scope.llamamos = true;
      	}
		/**
		* Función que envía un email de tipo short (menos info)
		**/
      	$scope.sendMailConsulta = function() {
      		$http({
      	        url: '/mail.php',
      	        method: "POST",
      	        data: $.param({ 
          	        type: 'short'
          	        ,lang: $scope.lang
          	        ,asunto: '<?php echo  str_replace('/', '_', $xml) ?>'
  	        		,name: $scope.short.name
  	        		,emilio: $scope.short.email
  	        		,txt: $scope.short.txt
  	        		,subject: ''
  	  	        	,body: ''
  	        	}),
  	         	headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      	    }).success(function(response) {
	    		$("#myModal").modal();
	    		$scope.short = {};
	    		$scope.consulta.$setPristine();
	    	});
      	}
		/**
		* Función que envía un email de tipo short (menos info)
		**/
      	$scope.sendMailConsultaDos = function() {
      		$http({
      	        url: '/mail.php',
      	        method: "POST",
      	        data: $.param({ 
          	        type: 'short'
          	        ,lang: $scope.lang
          	        ,asunto: '<?php echo  str_replace('/', '_', $xml) ?>'
  	        		,name: $scope.short.name
  	        		,emilio: $scope.short.email
  	        		,txt: $scope.short.txt
  	        		,subject: ''
  	  	        	,body: ''
  	        	}),
  	         	headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      	    }).success(function(response) {
	    		$("#myModal").modal();
	    		$scope.short = {};
	    		$scope.consulta2.$setPristine();
	    	});
      	}
		/**
		* Función que envía un email de tipo long (más info)
		**/
      	$scope.sendMailMasInfo = function() {
      		$http({
      	        url: '/mail.php',
      	        method: "POST",
      	        data: $.param({ 
          	        type: 'long'
          	        ,lang: $scope.lang
          	        ,asunto: '<?php echo  str_replace('/', '_', $xml) ?>'
  	        		,name: $scope.long.name
  	        		,emilio: $scope.long.email
  	        		,txt: $scope.long.message
  	        		,telf: $scope.long.telf
  	        		,deliver: $scope.long.canal
  	        		,subject: ''
  	  	        	,body: ''
  	        	}),
  	         	headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      	    }).success(function(response) {
	    		$("#myModal").modal();
	    		$scope.long = {};
	    		$scope.mas_info.$setPristine();
	    	});
      	}
		/**
		* Función que envía un email de contacto
		**/
      	$scope.sendMailContact = function() {
      		$http({
      	        url: '/mail.php',
      	        method: "POST",
      	        data: $.param({ 
          	        type: 'contact'
          	        ,lang: $scope.lang
          	        ,asunto: '<?php echo  str_replace('/', '_', $xml) ?>'
  	        		,name: $scope.contact.name
  	        		,emilio: $scope.contact.email
  	        		,txt: $scope.contact.message
  	        		,telf: $scope.contact.telf
  	        		,country: $scope.contact.country.name
  	        		,interest: $scope.contact.interest.value[$scope.lang]
  	        		,deliver: $scope.contact.canal
  	        		,subject: ''
  	  	        	,body: ''
  	        	}),
  	         	headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      	    }).success(function(response) {
	    		$("#myModal").modal();
	    		$scope.contact = {};
	    		$scope.clinica_obesidad.$setPristine();
	    	});
      	}
		/**
		* Función que envía un email de contacto
		**/
      	$scope.sendMailLlamamos = function() {
      		$http({
      	        url: '/mail.php',
      	        method: "POST",
      	        data: $.param({ 
          	        type: 'llamamos'
          	        ,lang: $scope.lang
          	        ,asunto: '<?php echo  str_replace('/', '_', $xml) ?>'
  	        		,name: $scope.call.name
  	        		,telf: $scope.call.telf
  	        		,emilio: 'No procede'
  	        		,txt: 'Llamar al interesado.'
  	        		,subject: ''
  	  	        	,body: ''
  	        	}),
  	         	headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
      	    }).success(function(response) {
	    		$("#myModal").modal();
	    		$scope.call = {};
	    		$scope.form_llamamos.$setPristine();
	    		$scope.llamamos = false;
	    	});
      	}
		/**
		* Crea una cookie para todo el dominio
		**/
      	$scope.createCookie = function() {
      		$http.get('/cookie.php?name=msgcookie').
	    	success(function(response) {
	    		console.log(response);
	    	});
      	}
	});
	</script>
</body>
</html>