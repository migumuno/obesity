/**
 * Declaro los config con las rutas
 */
app.config(["$routeProvider", function($routeProvider){
	$routeProvider.when('/dashboard', {
		templateUrl: "/dashboard.html"
		,controller: "DashboardController"
	});
	
	$routeProvider.when('/calendar', {
		templateUrl: "/calendar.html"
		,controller: "CalendarController"
	});
	
	$routeProvider.when('/messages', {
		templateUrl: "/messages.html"
		,controller: "MessagesController"
	});
	
	$routeProvider.when('/patient', {
		templateUrl: "/patient.html"
		,controller: "PatientController"
	});
	
	$routeProvider.when('/chat', {
		templateUrl: "/chat.html"
		,controller: "ChatController"
	});
	
	$routeProvider.otherwise({
		redirectTo: '/dashboard'
	});
}]);