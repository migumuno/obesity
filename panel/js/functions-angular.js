/**
 * Genera las promesas de peticiones $http remotas
 */
function RemoteResource ($http, $q, type) {
	this.patient_info = function() {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_patient_info'}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
	
	this.people = function() {
		if (type == 0)
			var url = 'get_admins';
		else
			var url = 'get_patients';
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: url}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
	
	this.allEvents = function() {
		if (type == 0)
			var url = 'get_patient_events';
		else
			var url = 'get_all_events';
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: url}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
	
	this.limit_files = function() {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_files', limit: "10"}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}

	this.all_admins = function() {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_admins'}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
	
	this.unread_messages = function() {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_unread_messages'}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
	
	this.all_messages = function() {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_all_messages'}
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
}

function RemoteResourceProvider (){
	var _type;
	
	this.setType = function(type) {
		_type = type;
	}
	this.$get = ['$http', '$q', function($http, $q){
		return new RemoteResource($http, $q, _type);
	}];
}