/**
 * Obtiene el objeto del file
 */
app.directive("fileread", ['$http', function ($http) { //Directiva del input file como atributo
	return {
		$scope: {
			fileread: "="
		},
		link: function ($scope, element, attributes) {
			/*Evento que salta cuando eliges documentos*/
			element.bind("change", function (changeEvent) {
				$scope.$apply(function () {
					//Recogemos los archivos
					$scope.files = changeEvent.target.files;
					
					for (var i = 0; i < $scope.files.length; i++) {
						$scope.file = $scope.files[i];
					}
				});
			});
		}
	}
}]);

/**
 * Representa una notificación
 */
app.directive('emInfoadmin', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="infoAdmin" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.edit_info[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<form name="info_admin" novalidate>'+
										'<div class="form-group">'+
			                      			'<label>{{dictionary.fields.name[lang]}}*</label>'+
			                      			'<input ng-model="admin.nombre" type="text" name="name" placeholder="{{user.name}}" required class="form-control" autocomplete="off">'+
											'<div ng-show="info_admin.name.$touched && !info_admin.$pristine">'+
												'<span ng-show="info_admin.name.$error.required" class="alert">{{dictionary.alerts.required[lang]}}</span>'+
											'</div>'+
										'</div>'+
										'<div class="modal-footer">'+
											'<input type="submit" class="btn btn-default" ng-click="editPatient()" data-dismiss="modal" ng-disabled="!info_admin.$valid" value="{{dictionary.fields.edit[lang]}}">'+
											'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
										'</div>'+
									'</form>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emInfopatient', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="infoPatient" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.edit_info[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<form name="info_patient" novalidate>'+
										'<div class="form-group">'+
											'<div class="row">'+
												'<div class="col-sm-6">'+
													'<label>{{dictionary.fields.mail[lang]}}*</label>'+
													'<input ng-model="patient.email" type="email" name="mail" placeholder="{{p.email}}" class="form-control">'+
													'<div ng-show="info_patient.mail.$touched && !info_patient.$pristine">'+
														'<span ng-show="info_patient.mail.$error.email" class="alert">{{dictionary.alerts.mailpattern[lang]}}</span>'+
													'</div>'+
												'</div>'+
												'<div class="col-sm-6">'+
													'<label>{{dictionary.fields.telf[lang]}}*</label>'+
													'<input ng-model="patient.telf" type="text" name="telf" placeholder="{{p.telf}}" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" class="form-control">'+
													'<div ng-show="info_patient.telf.$touched && !info_patient.$pristine">'+
														'<span ng-show="info_patient.telf.$error.pattern" class="alert">{{dictionary.alerts.pattern[lang]}}</span>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<div class="modal-footer">'+
											'<input type="submit" class="btn btn-default" ng-click="editPatient()" ng-disabled="!info_patient.$valid" value="{{dictionary.fields.edit[lang]}}">'+
											'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
										'</div>'+
									'</form>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Cambia la pass
 */
app.directive('emChangepass', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="changePass" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.change_pass[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<form name="change_pass" novalidate>'+
										'<div class="form-group">'+
											'<div class="row">'+
												'<div class="col-sm-6">'+
													'<label>{{dictionary.fields.pass[lang]}}*</label>'+
													'<input ng-model="pass.pass" type="password" name="pass" class="form-control" required>'+
													'<div ng-show="change_pass.pass.$touched && !change_pass.$pristine">'+
														'<span ng-show="registro.pass.$error.required" class="alert">{{dictionary.alerts.required[lang]}}</span>'+
													'</div>'+
												'</div>'+
												'<div class="col-sm-6">'+
													'<label>{{dictionary.fields.pass_verify[lang]}}*</label>'+
													'<input ng-model="pass.pass_old" type="password" name="pass_old" class="form-control" required>'+
													'<div ng-show="change_pass.pass_old.$touched && !change_pass.$pristine">'+
														'<span ng-show="registro.pass_old.$error.required" class="alert">{{dictionary.alerts.required[lang]}}</span>'+
													'</div>'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<div class="modal-footer">'+
											'<input type="submit" class="btn btn-default" ng-click="changePass()" ng-disabled="!change_pass.$valid" value="{{dictionary.fields.edit[lang]}}">'+
											'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
										'</div>'+
									'</form>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emNotifcreate', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="notifCreate" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.notifCreate[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emNotifedit', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="notifEdit" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.notifEdit[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emNotiferase', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="notifErase" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.notifErase[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emNotiffile', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="notifFile" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.notifFile[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación
 */
app.directive('emNotifmessage', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="notifMessage" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.notifMessage[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación de confirmación
 */
app.directive('emConfirm', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="cancelConfirm" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-notif">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-info-circle"></i> {{dictionary.texts.notif[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.cancelConfirm[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación de confirmación
 */
app.directive('emErrormessage', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="errorMessage" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-error">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-warning"></i></i> {{dictionary.texts.error[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.errorMessage[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación de confirmación
 */
app.directive('emErrorgeneral', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="errorGeneral" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-error">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-warning"></i></i> {{dictionary.texts.error[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.errorGeneral[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);

/**
 * Representa una notificación de confirmación
 */
app.directive('emErrorpass', [function(){
	var directive = {
		restrict: "E"
		,replace: true
		,scope: false
		,template:  '<div class="modal" id="errorPass" role="dialog">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header-error">'+
									'<button type="button" class="close" data-dismiss="modal">&times;</button>'+
									'<h4 class="modal-title"><i class="fa fa-warning"></i></i> {{dictionary.texts.error[lang]}}</h4>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>{{dictionary.messages.errorPass[lang]}}</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-default" data-dismiss="modal">{{dictionary.texts.close[lang]}}</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'
	}
		
	return directive;
}]);