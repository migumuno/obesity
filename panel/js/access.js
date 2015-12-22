/**
 * Declaro los config con las rutas
 */
app.config(["$routeProvider", function($routeProvider){
	$routeProvider.when('/login', {
		templateUrl: "/templates/login.html"
		,controller: "AccessController"
	});
	
	$routeProvider.when('/adminLogin', {
		templateUrl: "/templates/adminLogin.html"
		,controller: "AccessController"
	});
	
	$routeProvider.when('/recover', {
		templateUrl: "/templates/recover.html"
		,controller: "AccessController"
	});
	
	$routeProvider.when('/changePass', {
		templateUrl: "/templates/changePass.html"
		,controller: "AccessController"
	});
	
	$routeProvider.when('/activate', {
		templateUrl: "/templates/activate.html"
		,controller: "AccessController"
	});
	
	$routeProvider.otherwise({
		redirectTo: 'login'
	});
}]);

/**
 * Incluye una directiva para comprobar la coincidencia de contraseñas
 * Incluir data-password-verify="nombre del ng-model de la otra pass" en la segunda pass
 * <div ng-show="form.confirm_password.$error.passwordVerify">Fields are not equal!</div> Para mostrar el error
 */
app.directive("passwordVerify", function() {
   return {
      require: "ngModel",
      scope: {
        passwordVerify: '='
      },
      link: function(scope, element, attrs, ctrl) {
        scope.$watch(function() {
            var combined;

            if (scope.passwordVerify || ctrl.$viewValue) {
               combined = scope.passwordVerify + '_' + ctrl.$viewValue; 
            }                    
            return combined;
        }, function(value) {
            if (value) {
                ctrl.$parsers.unshift(function(viewValue) {
                    var origin = scope.passwordVerify;
                    if (origin !== viewValue) {
                        ctrl.$setValidity("passwordVerify", false);
                        return undefined;
                    } else {
                        ctrl.$setValidity("passwordVerify", true);
                        return viewValue;
                    }
                });
            }
        });
     }
   };
});

/**
 * Declaro un factory que me devuelve XMLs
 */
app.factory("xmlContent", ['$http', function($http){
	return function (file) {
		return $http({
			method: 'POST'
			,url: '/tcp.php'
			,data: {xml: file}
		});
	}
}]);

/**
 * Declaro los controladores para las diferentes vistas
 */
app.controller("AccessController", ['$scope', 'xmlContent', 'idioma', 'clave', '$http', function($scope, xmlContent, idioma, clave, $http){
	$scope.lang = idioma;
	$scope.clave = clave;
	xmlContent('dictionary').success(function(data){
		$scope.dictionary = data;
	});
	
	$scope.changeLang = function(lang) {
		$scope.lang = lang;
	}
}]);