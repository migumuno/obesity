/*************************************************************INICIO PANEL CONTROLLER*************************************************************************************/



/**
 * Declaro el controlador general
 */
app.controller("PanelController", ['$scope', 'xmlContent', 'idioma', 'user', '$http', 'paciente', 'remoteResource', function($scope, xmlContent, idioma, user, $http, paciente, remoteResource){
	//Variables
	$scope.lang = idioma;
	$scope.user = user;
	$scope.alerta = '';
	$scope.search = {};
	$scope.patient = {};
	$scope.p = {};
	$scope.pass = {};
	
	//Métodos
	/**
	 * Obtiene el diccionario de textos general
	 */
	xmlContent('dictionary').success(function(data){
		$scope.dictionary = data;
	});
	
	/**
	 * Obtiene toda la información del paciente
	 */
	remoteResource.patient_info().then(function(info){
		$scope.p = info[0];
	}, function(status){
		$("#errorGeneral").modal();
	});
	
	/**
	 * Obtengo todos los administradores o pacientes, dependiendo del tipo de usuario
	 */
	remoteResource.people().then(function(people){
		$scope.people = people;
	}, function(status){
		$("#errorGeneral").modal();
	});
	
	/**
	 * Recarga people
	 */
	$scope.refreshPeople = function () {
		if ($scope.user.type == 0) {
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'get_admins'}
			}).success(function(data){
				$scope.people = data;
			});
		} else if ($scope.user.type == 1 || $scope.user.type == 2) {
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'get_patients'}
			}).success(function(data){
				$scope.people = data;
			});
		}
	}
	
	/**
	 * Selecciono el destinatario del mensaje
	 */
	$scope.setPatient = function() {
		$scope.search.to = $scope.people[$scope.search.aux].id_patient;
		$scope.search.aux = $scope.people[$scope.search.aux].nombre;
	}
	
	$scope.updateInfoPatient = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_patient_info'}
		}).success(function(data){
			$scope.p = data[0];
		});
	}
	
	/**
	 * Muestra el formulario de edición de la info
	 */
	$scope.showInfo = function(){
		if($scope.user.type == 0)
			$("#infoPatient").modal();
		else
			$("#infoAdmin").modal();
	}
	
	/**
	 * Muestra el formulario de edición de la info
	 */
	$scope.showChangePass = function(){
		$("#changePass").modal();
	}
	
	/**
	 * Edita la info del paciente
	 */
	$scope.editPatient = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'update_patient', patient: $scope.patient}
		}).success(function(data){
			$("#infoPatient").modal('hide');
			$("#notifEdit").modal();
			$scope.patient = {};
			$scope.info_patient.$setPristine();
			$scope.updateInfoPatient();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
	
	/**
	 * Cambia la contraseña
	 */
	$scope.changePass = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'change_pass', pass: $scope.pass.pass, pass_old: $scope.pass.pass_old}
		}).success(function(data){
			$("#changePass").modal('hide');
			if (data == '			error')
				$("#errorPass").modal();
			else
				$("#notifEdit").modal();
			$scope.pass = {};
			$scope.change_pass.$setPristine();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
}])



/***********************************************************FIN PANEL CONTROLLER*************************************************************************************/



/***********************************************************INICIO DASHBOARD CONTROLLER******************************************************************************/



/**
 * Controla la vista del tablero
 */
app.controller("DashboardController", ['$scope', 'xmlContent', 'calendar', '$http', '$filter', 'remoteResource', function($scope, xmlContent, calendar, $http, $filter, remoteResource){
	//Variables
	$scope.paciente = {};
	$scope.num_msgs = 0;
	$scope.nextCitas = [];
	$scope.archivo = {};
	$scope.ficheros = {};
	$scope.admin = {};
	$scope.admins = {};
	$scope.readmin = {};
	$scope.form_admins = 1;
	
	//Métodos
	/**
	 * Obtiene el diccionario de textos del tablero
	 */
	xmlContent('dashboard').success(function(data){
		$scope.dashboard = data;
	});
	
    /**
	 * Inicializa el calendario con las citas
	 */
	remoteResource.allEvents().then(function(data){
		var clases = {0: '#fcc633', 1: '#1bbacc'};
		if (data != '			vacio')
			$scope.allEvents = data;
		else
			$scope.allEvents = {};
		var eventos = [];
		for (var i=0; i < $scope.allEvents.length; i++) {
			if (($scope.user.type != 0 && $scope.allEvents[i].tipo == 0) || ($scope.user.type == 0)) {
				fecha = $scope.allEvents[i].fecha.replace(/-/g, "/");
				aux = [$filter('date')(new Date(fecha), "d/M/yyyy"), $scope.allEvents[i].titulo, "#", clases[$scope.allEvents[i].tipo], $scope.allEvents[i].texto];
				eventos.push(aux);
			}
			if ($scope.allEvents[i].tipo == 0 && (new Date() < new Date(fecha))) {
				aux = $scope.allEvents[i];
				aux.fecha = aux.fecha.replace(/-/g, "/");
				aux.fecha = $filter('date')(new Date(aux.fecha), "d/M/yyyy hh:mm:dd");
				$scope.nextCitas.push(aux);
			}
		}
		calendar(eventos);
	}, function(status){
		
	});
	
	/**
	 * Obtiene los últimos 10 archivos recibidos
	 */
	remoteResource.limit_files().then(function(files){
		if (files == '			vacio')
			$scope.ficheros = {};
		else
			$scope.ficheros = files;
	}, function(status){
		
	});
	
	/**
	 * Obtiene los mensajes no leidos
	 */
	remoteResource.unread_messages().then(function(messages){
		if (messages == '			vacio')
			$scope.msg = {};
		else {
			$scope.msg = messages;
			$scope.num_msgs = messages.length;
		}
	}, function(status){
		
	});

	/**
	 * Obtiene todos los administradores dados de alta.
	 */
	remoteResource.all_admins().then(function(administradores){
		if (administradores == '			vacio')
			$scope.admins = {};
		else {
			$scope.admins = administradores;
		}
	}, function(status){
		
	});

	$scope.showEditAdmin = function (id, value) {
		$scope.readmin.admin = id;
		$scope.form_admins = value;
	}
	
	/**
	 * Inserta un nuevo paciente
	 */
	$scope.insertPatient = function () {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {patient: $scope.paciente, action: 'insert_patient'}
		}).success(function(data){
			if (data != '			ok') {
				$("#errorGeneral").modal();
			} else {
				$("#notifCreate").modal();
			}
		}).error(function(){
			$("#errorGeneral").modal();
		});
		$scope.paciente = {};
		$scope.registro.$setPristine();
	}

	/**
	 * Inserta un nuevo administrador
	 */
	$scope.insertAdmin = function () {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {admin: $scope.admin, action: 'insert_admin'}
		}).success(function(data){
			if (data != 'ok') {
				$scope.titulo_alerta = {es: 'Error', en: 'Error', de: 'Error'};
				$scope.alerta = data;
			} else {
				$scope.titulo_alerta = {es: 'Todo OK!', en: 'Error', de: 'Error'};
				$scope.alerta = '';
			}
			$("#notifCreate").modal();
		}).error(function(){
			$("#errorGeneral").modal();
		});
		$scope.admin = {};
		$scope.registroAdmin.$setPristine();
	}

	/**
	 * Edita la pass de un administrador
	 */
	$scope.editAdmin = function () {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {admin: $scope.readmin, action: 'edit_admin'}
		}).success(function(data){
			if (data != 'ok') {
				$scope.titulo_alerta = {es: 'Error', en: 'Error', de: 'Error'};
				$scope.alerta = data;
			} else {
				$scope.titulo_alerta = {es: 'Todo OK!', en: 'Error', de: 'Error'};
				$scope.alerta = '';
			}
			$("#notifCreate").modal();
		}).error(function(){
			$("#errorGeneral").modal();
		});
		$scope.readmin = {};
		$scope.editarAdministrador.$setPristine();
	}

	/**
	 * Elimina un administrador
	 */
	$scope.eraseAdmin = function (id) {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {admin: id, action: 'erase_admin'}
		}).success(function(data){
			if (data != 'ok') {
				$scope.titulo_alerta = {es: 'Error', en: 'Error', de: 'Error'};
				$scope.alerta = data;
			} else {
				$scope.titulo_alerta = {es: 'Todo OK!', en: 'Error', de: 'Error'};
				$scope.alerta = '';
			}
			$("#notifCreate").modal();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
	
	/**
	 * Sube el archivo
	 */
	$scope.uploadArchivo = function(file){
		var data = new FormData();
		data.append('fichero', file);
		data.append('size', file.size);
		data.append('name', file.name);
		data.append('type', file.type);
		data.append('nombre', $scope.archivo.nombre);
		data.append('action', 'upload_file');
		$http.post('/api.php',data,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).success(function(data, status, headers, config) {
			$("#notifFile").modal();
			$scope.getFiles();
			$scope.archivo = {};
			$scope.archivos.$setPristine();
			angular.element('miarchivo').val(null);
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
	
	/**
	 * Obtiene todos los archivos del paciente
	 */
	$scope.getFiles = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_files'}
		}).success(function(data){
			if (data == '			vacio')
				$scope.ficheros = {};
			else
				$scope.ficheros = data;
		});
	}
	
	/**
	 * Elimina una nota
	 */
	$scope.eraseFile = function(id_file) {
		var response = confirm('¿Seguro que quieres continuar con el borrado?');
		if (response == true) {
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'erase_file', id: id_file}
			}).success(function(data){
				$scope.getFiles();
				$("#notifErase").modal();
			}).error(function(){
				$("#errorGeneral").modal();
			});
		} else
			$("#cancelConfirm").modal();
	}
}]);



/*********************************************************FIN DASHBOARD CONTROLLER*******************************************************************************/



/*********************************************************INICIO CALENDAR CONTROLLER*****************************************************************************/



/**
 * Controla la vista del calendario
 */
app.controller("CalendarController", ['$scope', 'xmlContent', 'fullCalendar', '$route', 'datePicker', '$http', '$filter', 'remoteResource', function($scope, xmlContent, fullCalendar, $route, datePicker, $http, $filter, remoteResource){
	$scope.calendar = {};
	$scope.temp = {};
	$scope.calendarWindow = 0;
	$scope.calendarWindowMode = 'create';
	$scope.ficha;
	$scope.numEvent = '-1';
	
	//Métodos
	/**
	 * Obtiene el diccionario de textos del calendario
	 */
	xmlContent('calendar').success(function(data){
		$scope.calendario = data;
	});
	
	/**
	 * Inicializa el calendario con todos los eventos
	 */
	remoteResource.allEvents().then(function(data){
		var clases = {0: 'b-l b-2x b-warning', 1: 'b-l b-2x b-primary'};
		$scope.allEvents = data;
		var eventos = [];
		for (var i=0; i < $scope.allEvents.length; i++) {
			aux = {title: $scope.allEvents[i].titulo, className: clases[$scope.allEvents[i].tipo], start: $scope.allEvents[i].fecha, allDay: false, identificador: i};
			eventos.push(aux);
		}
		fullCalendar(eventos);
	}, function(status){
		
	});
	
	/**
	 * Escucha cuando cambia el evento seleccionado y muestra la ventana correspondiente
	 */
	$scope.$watch("numEvent",function(newValue,oldValue) {
	   if (newValue===oldValue) {
		   return;
	   }
	   if (newValue != '-1') {
		   $scope.calendarWindow = 1;
		   $scope.ficha = $scope.allEvents[newValue];
		}
	});
	
	/**
	 * Configura las ventanas de texto de calendario
	 */
	$scope.changeCalendarWindow = function(id) {
		if (id == 2) {
			$scope.calendar.titulo = $scope.ficha.titulo;
			$scope.calendar.comentario = $scope.ficha.comentario;
			$scope.calendar.texto = $scope.ficha.texto;
			$scope.calendar.fecha = $scope.ficha.fecha;
			$scope.temp.tipo = $scope.ficha.tipo;
			$scope.calendarWindow = 0;
			$scope.calendarWindowMode = 'edit';
			$scope.numEvent = '-1';
		} else if (id == 0) {
			$scope.calendarWindowMode = 'create';
			$scope.calendarWindow = id;
			$scope.numEvent = '-1';
		} else if (id == 3) {
			$scope.calendarWindowMode = 'create';
			$scope.calendarWindow = 0;
			$scope.calendar = {};
			$scope.temp = {};
		} else {
			$scope.calendarWindow = id;
			$scope.calendarWindowMode = 'create';
		}
	}
	
	$scope.changeEvent = function(index) {
		$scope.numEvent = index;
		$scope.$watch("numEvent",function(index) {
			console.log(index);
		});
		$scope.calendarWindow = 1;
	}
	
	/**
	 * Inicializo los date picker
	 */
	$('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'es-BR',
        pick12HourFormat: true,
        pickTime: true
    });
	
	/**
	 * Obtiene todas las citas. Dependiendo si la sesión es de paciente o de admin busca sólo las del paciente o todas.
	 */
	$scope.updateEvents = function(tipo) {
		$route.reload();
	}
	
	/**
	 * Añade un evento al calendario
	 */
	$scope.createEvent = function() {
		$scope.calendar.fecha = $filter('date')(document.getElementById('fecha_entrada').value, "yyyy-MM-dd HH:mm:ss");
		if ($scope.calendar.fecha != '' && $scope.calendar.fecha != undefined) {
			var to = 'insert_recordatorio';
			if ($scope.temp.tipo == 'cita')
				to = 'insert_cita';
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: to, calendar: $scope.calendar}
			}).success(function(data){
				$scope.updateEvents();
				/*Configuro y lanzo la notificación*/
				$("#notifCreate").modal();
			});
		}
	}
	
	/**
	 * Edita un evento del calendario
	 */
	$scope.editEvent = function() {
		if (document.getElementById('fecha_entrada').value != '' && document.getElementById('fecha_entrada').value != undefined)
			$scope.calendar.fecha = $filter('date')(document.getElementById('fecha_entrada').value, "yyyy-MM-dd HH:mm:ss");
		if ($scope.ficha.tipo == 0) 
			var to = 'update_cita';
		else
			var to = 'update_recordatorio';
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: to, calendar: $scope.calendar, id: $scope.ficha.id_calendar}
		}).success(function(data){
			/*Configuro y lanzo la notificación*/
			$("#notifEdit").modal();
			$scope.updateEvents();
		});
	}
	
	/**
	 * Elimina un evento del calendario.
	 */
	$scope.eraseEvent = function() {
		var response = confirm('¿Seguro que quieres continuar con el borrado?');
		if (response == true) {
			if ($scope.ficha.tipo == '0')
				var to = 'delete_cita';
			else
				var to = 'delete_recordatorio';
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: to, id: $scope.ficha.id_calendar}
			}).success(function(data){
				$scope.calendar = {};
				$scope.add_event.$setPristine();
				$scope.updateEvents();
				$scope.calendarWindowMode = 'create';
				$scope.calendarWindow = 0;
				$("#notifErase").modal();
			}).error(function(){
				$("#errorGeneral").modal();
			});
		} else
			$("#cancelConfirm").modal();
	}
	
	/**
	 * Selecciono el destinatario del mensaje
	 */
	$scope.setDestinatario = function() {
		$scope.calendar.id_patient = $scope.people[$scope.temp.aux].id_patient;
		$scope.temp.aux = $scope.people[$scope.temp.aux].nombre;
	}
	
	/**
	 * Abre un evento en la ficha
	 */
	$scope.openEvent = function(index) {
		$scope.ficha = $scope.allEvents[index];
		$scope.calendarWindow  = 1;
	}
}]);



/**********************************************************************FIN CALENDAR CONTROLLER*********************************************************************/



/**********************************************************************INICIO MESSAGES CONTROLLER*********************************************************************/


/**
 * Controla la vista de mensajes
 */
app.controller("MessagesController", ['$scope', 'xmlContent', 'numDays', '$http', 'remoteResource', function($scope, xmlContent, numDays, $http, remoteResource){
	//Variables
	$scope.message_window = 0;
	$scope.num_msg_unread = 0;
	$scope.msg_selected;
	$scope.mode = 'all';
	$scope.num_msgs = 0;
	$scope.mensaje = {};
	
	//Métodos
	/**
	 * Obtiene el diccionario de textos de mensajes
	 */
	xmlContent('messages').success(function(data){
		$scope.messages = data;
	});
	
	/**
	 * Obtiene la cantidad de días transcurridos
	 */
	$scope.numDias = function(fecha) {
		return numDays(new Date(), fecha);
	}
	
	/**
	 * Obtiene todos los mensajes
	 */
	remoteResource.all_messages().then(function(messages){
		if (messages == '			vacio')
			$scope.msg = {};
		else
			$scope.msg = messages;
	}, function(status){
		
	});
	
	/**
	 * Obtengo los mensajes no leídos
	 */
	remoteResource.unread_messages().then(function(messages){
		if (messages == '			vacio')
			$scope.unread = 0;
		else {
			$scope.unread = messages;
			$scope.num_msgs = messages.length;
		}
	}, function(status){
		
	});
	
	/**
	 * Obtiene los mensajes filtrados en función del filtro indicado
	 * @param string filtro
	 */
	$scope.filter = function(filtro) {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_'+filtro+'_messages'}
		}).success(function(data){
			if (data == '			vacio')
				$scope.msg = {};
			else
				$scope.msg = data;
			$scope.mode = filtro;
			$scope.message_window = 0;
		});
	}
	/**
	 * Cambia entre las diferentes ventanas de mensajes
	 * @param int window
	 */
	$scope.change_message_window = function (window) {
		$scope.message_window = window;
	}
	/**
	 * Recarga los mensajes
	 */
	$scope.refreshMsg = function(close) {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_all_messages'}
		}).success(function(data){
			if (data == '			vacio')
				$scope.msg = {};
			else
				$scope.msg = data;
			$scope.mode = 'all';
			if (close)
				$scope.message_window = 0;
		});
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_unread_messages'}
		}).success(function(data){
			if (data != '			vacio')
				$scope.num_msgs = data.length;
			else
				$scope.num_msgs = 0;
		});
	}
	/**
	 * Muestra el mensaje seleccionado
	 */
	$scope.showMessage = function (id) {
		$scope.msg_selected = $scope.msg[id];
		$scope.message_window = 1;
		if ($scope.msg_selected.leido == 0)
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'set_read', id:$scope.msg_selected.id_message_user}
			}).success(function(data){
				$scope.refreshMsg(false);
			});
	}
	/**
	 * Marca como no leido el mensaje seleccionado
	 */
	$scope.markUnread = function () {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'set_unread', id:$scope.msg_selected.id_message_user}
		}).success(function(data){
			$scope.refreshMsg(true);
		});
	}
	/**
	 * Borra el mensaje seleccionado
	 */
	$scope.eraseMessage = function () {
		if ($scope.msg_selected.eliminado == 0)
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'set_erase', id:$scope.msg_selected.id_message_user}
			}).success(function(data){
				$scope.refreshMsg(true);
			});
	}
	/**
	 * Borra el mensaje seleccionado
	 */
	$scope.eraseSendMessage = function () {
		if ($scope.msg_selected.eliminado == 0)
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'set_eraseSend', id:$scope.msg_selected.id_message_user}
			}).success(function(data){
				$scope.refreshMsg(true);
			});
	}
	/**
	 * Borra el mensaje seleccionado
	 */
	$scope.uneraseMessage = function () {
		if ($scope.msg_selected.eliminado == 1)
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'set_unerase', id:$scope.msg_selected.id_message_user}
			}).success(function(data){
				$scope.refreshMsg(true);
			});
	}
	/**
	 * Envía un mensaje
	 */
	$scope.sendMessage = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'send_message', mensaje: $scope.mensaje}
		}).success(function(data){
			$scope.msg = data;
			$("#notifMessage").modal();
		}).error(function(){
			$("#errorMessage").modal();
		});
		$scope.mensaje = {};
		$scope.new_message.$setPristine();
	}
	/**
	 * Selecciono el destinatario del mensaje
	 */
	$scope.setDestinatario = function() {
		if ($scope.user.type == 0)
			$scope.mensaje.to = $scope.people[$scope.mensaje.aux].id_admin;
		else
			$scope.mensaje.to = $scope.people[$scope.mensaje.aux].id_patient;
		$scope.mensaje.aux = $scope.people[$scope.mensaje.aux].nombre;
	}
}]);



/************************************************************************FIN MESSAGES CONTROLLER*************************************************************************************/



/************************************************************************INICIO PATIENT CONTROLLER***********************************************************************************/



/**
 * Controla la vista de paciente
 */
app.controller("PatientController", ['$scope', '$http', 'xmlContent', 'paciente', '$filter', '$route', 'remoteResource', 'promesasHttp', function($scope, $http, xmlContent, paciente, $filter, $route, remoteResource, promesasHttp){
	$scope.p = paciente;
	$scope.nota = {};
	$scope.note_mode = 'create';
	$scope.note_editing;
	$scope.calendar = {};
	$scope.temp = {};
	$scope.archivo = {};
	$scope.ficheros = {};
	$scope.edit_patient = 0;
	$scope.pct = {};
	
	//Métodos
	/**
	 * Obtiene el diccionario de textos de la página de historial de paciente
	 */
	xmlContent('patient').success(function(data){
		$scope.patient = data;
	});
	/**
	 * Obtiene todas las notas asociadas al paciente por el admin
	 */
	promesasHttp({action: 'get_notes', id: paciente}).then(function(data){
		if (data == '			vacio')
			$scope.notes = {};
		else
			$scope.notes = data;
	}, function(status){
		
	});
	
	/**
	 * Obtiene todas las notas asociadas al paciente por el admin
	 */
	promesasHttp({action: 'get_files', paciente: paciente}).then(function(data){
		if (data == '			vacio')
			$scope.ficheros = {};
		else
			$scope.ficheros = data;
	}, function(status){
		
	});
	
	/**
	 * Inicializo los date picker
	 */
	$('#datetimepicker1').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'es-BR',
        pick12HourFormat: true,
        pickTime: true
    });
	
	/**
	 * Obtiene toda la información del paciente
	 */
	promesasHttp({action: 'get_patient_info', id: paciente}).then(function(data){
		$scope.p_search = data[0];
		console.log(data[0]);
	}, function(status){
		
	});
	
	/**
	 * Muestra el formulario para editar la info del paciente
	 */
	$scope.showFormEditPatient = function(val) {
		$scope.edit_patient = val;
	}
	
	/**
	 * Crea una nota
	 */
	$scope.createNote = function() {
		$scope.nota.id_patient = paciente;
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'insert_note', note: $scope.nota}
		}).success(function(data){
			$("#notifCreate").modal();
			$scope.nota = {};
			$scope.anotaciones.$setPristine();
			$scope.getNotes();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
	/**
	 * Se encarga de ejecutar una edición a una creación de una nota en función de la acción configurada en el $scope
	 */
	$scope.doSomethingWithNote = function() {
		switch ($scope.note_mode) {
			case 'create':
				$scope.createNote();
				break;
			case 'edit':
				$scope.editNote($scope.notes[$scope.note_editing].id_note);
				break;
		};
		$scope.note_mode = 'create';
	}
	/**
	 * Actualiza el formulario para poder editar la nota, recibe el identificador de la nota
	 */
	$scope.setEdit = function(index) {
		$scope.note_editing = index;
		$scope.nota.titulo = $scope.notes[index].titulo;
		$scope.nota.texto = $scope.notes[index].texto;
		$scope.note_mode = 'edit';
	}
	/**
	 * Actualiza una nota
	 */
	$scope.editNote = function(id_nota) {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'update_note', note: $scope.nota, id: id_nota}
		}).success(function(data){
			$("#notifEdit").modal();
			$scope.nota = {};
			$scope.anotaciones.$setPristine();
			$scope.getNotes();
		}).error(function(){
			$("#errorGeneral").modal();
		});;
	}
	/**
	 * Elimina una nota
	 */
	$scope.eraseNote = function(id_nota) {
		var response = confirm('¿Seguro que quieres continuar con el borrado?');
		if (response == true) {
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'delete_note', id: id_nota}
			}).success(function(data){
				$scope.getNotes();
				$("#notifErase").modal();
			}).error(function(){
				$("#errorGeneral").modal();
			});
		} else
			$("#cancelConfirm").modal();
	}
	/**
	 * Obtiene todas las notas del paciente escritas por el admin
	 */
	$scope.getNotes = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_notes', id: paciente}
		}).success(function(data){
			if (data == '			vacio')
				$scope.notes = {};
			else
				$scope.notes = data;
		});
	}
	
	/**
	 * Añade un evento al calendario
	 */
	$scope.createEvent = function() {
		$scope.calendar.fecha = $filter('date')(document.getElementById('fecha_entrada').value, "yyyy-MM-dd HH:mm:ss");
		$scope.calendar.id_patient = paciente;
		if ($scope.calendar.fecha != '' && $scope.calendar.fecha != undefined) {
			var to = 'insert_recordatorio';
			if ($scope.temp.tipo == 'cita')
				to = 'insert_cita';
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: to, calendar: $scope.calendar}
			}).success(function(data){
				$("#notifCreate").modal();
				$scope.calendar = {};
				$scope.temp = {};
				$scope.add_event.$setPristine();
			}).error(function(){
				$("#errorGeneral").modal();
			});
		}
	}
	
	/**
	 * Sube el archivo
	 */
	$scope.uploadFile = function(){
		var data = new FormData();
		data.append('fichero', $scope.file);
		data.append('size', $scope.file.size);
		data.append('name', $scope.file.name);
		data.append('type', $scope.file.type);
		data.append('nombre', $scope.archivo.nombre);
		data.append('action', 'upload_file');
		data.append('paciente', paciente);
		$http.post('/api.php',data,{
			transformRequest: angular.identity,
			headers: {'Content-Type': undefined}
		}).success(function(data, status, headers, config) {
			$("#notifFile").modal();
			$scope.archivo = {};
			$scope.archivos.$setPristine();
			$scope.getFiles();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
	
	/**
	 * Obtiene todos los archivos del paciente
	 */
	$scope.getFiles = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_files', paciente: paciente}
		}).success(function(data){
			if (data == '			vacio')
				$scope.ficheros = {};
			else
				$scope.ficheros = data;
		});
	}
	
	/**
	 * Elimina una nota
	 */
	$scope.eraseFile = function(id_file) {
		var response = confirm('¿Seguro que quieres continuar con el borrado?');
		if (response == true) {
			$http({
				method: 'POST'
				,url: '/api.php'
				,data: {action: 'erase_file', id: id_file}
			}).success(function(data){
				$scope.getFiles();
				$("#notifErase").modal();
			}).error(function(){
				$("#errorGeneral").modal();
			});
		} else
			$("#cancelConfirm").modal();
	}
	
	$scope.actualizaInfoPatient = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'get_patient_info', id: paciente}
		}).success(function(data){
			$scope.p_search = data[0];
		});
	}
	
	/**
	 * Edita la info del paciente
	 */
	$scope.editPatient = function() {
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: {action: 'update_patient', patient: $scope.pct, id: paciente}
		}).success(function(){
			$("#notifEdit").modal();
			$route.reload();
		}).error(function(){
			$("#errorGeneral").modal();
		});
	}
}]);



/*************************************************************************FIN PATIENT CONTROLLER********************************************************************************************/



/************************************************************************INICIO PATIENT CONTROLLER***********************************************************************************/



/**
 * Controla la vista de paciente
 */
app.controller("ChatController", ['$scope', '$http', 'xmlContent', 'paciente', '$filter', '$route', function($scope, $http, xmlContent, paciente, $filter, $route){
	$( '#iframe_chat' ).css("height", $( window ).height() - 65);
}]);