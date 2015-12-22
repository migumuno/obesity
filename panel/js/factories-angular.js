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
 * Declaro un factory que me devuelve promesas de peticiones $http
 */
app.factory("promesasHttp", ['$http', '$q', function($http, $q){
	return function (datos) {
		var defered = $q.defer();
		var promise = defered.promise;
		
		$http({
			method: 'POST'
			,url: '/api.php'
			,data: datos
		}).success(function(data){
			defered.resolve(data);
		}).error(function(status){
			defered.reject(status);
		})
		
		return promise;
	}
}]);

/**
 * Declaro un factory que me devuelve XMLs
 */
app.factory("datePicker", function(){
	return function (name) {
		$( "#"+name ).datepicker({
	        changeMonth: true,
	        changeYear: true
	    });
		$( "#"+name ).datepicker( "option", "dateFormat", "dd/mm/yy" );
	}
});

/**
 * Calcula la cantidad de días transcurridos entre dos fechas
 */
app.factory('numDays', function(){
	return function(f1,f2) {
		var aFecha1 = f1.split('/'); 
	 	var aFecha2 = f2.split('/'); 
	 	var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
	 	var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
	 	var dif = fFecha2 - fFecha1;
	 	var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
	 	return dias;
	}
});

/**
 * Imprime el calendario pequeño. Recibe los eventos por parámetro
 */
app.factory('calendar', function(){
	return function(events) {
		var cTime = new Date(), month = cTime.getMonth()+1, year = cTime.getFullYear();
		  
	  	/*Colores: azul: #177bbb, verde: #1bbacc, naranja: #fcc633, rojo: #e33244*/

		theMonths = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

		theDays = ["D", "L", "M", "X", "J", "V", "S"];
	    $('#calendar').calendar({
	        months: theMonths,
	        days: theDays,
	        events: events,
	        popover_options:{
	            placement: 'top',
	            html: true
	        }
	    });
	}
});

/**
 * Imprime el calendario grande. Recibe los eventos por parámetro
 */
app.factory('fullCalendar', function(){
	return function(events) {
		+function ($) {
		  $(function(){
	
		    // fullcalendar
		    var date = new Date();
		    var d = date.getDate();
		    var m = date.getMonth();
		    var y = date.getFullYear();
		    var addDragEvent = function($this){
		      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		      // it doesn't need to have a start or end
		      var eventObject = {
		        title: $.trim($this.text()), // use the element's text as the event title
		        className: $this.attr('class').replace('label','')
		      };
		      
		      // store the Event Object in the DOM element so we can get to it later
		      $this.data('eventObject', eventObject);
		      
		      // make the event draggable using jQuery UI
		      $this.draggable({
		        zIndex: 999,
		        revert: true,      // will cause the event to go back to its
		        revertDuration: 0  //  original position after the drag
		      });
		    };
		    $('.calendar').each(function() {
		      $(this).fullCalendar({
		        header: {
		          left: 'prev',
		          center: 'title',
		          right: 'next'
		        },
		        editable: false,
		        droppable: false, // this allows things to be dropped onto the calendar !!!
		        drop: function(date, allDay) { // this function is called when something is dropped
		          
		            // retrieve the dropped element's stored Event Object
		            var originalEventObject = $(this).data('eventObject');
		            
		            // we need to copy it, so that multiple events don't have a reference to the same object
		            var copiedEventObject = $.extend({}, originalEventObject);
		            
		            // assign it the date that was reported
		            copiedEventObject.start = date;
		            copiedEventObject.allDay = allDay;
		            
		            // render the event on the calendar
		            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
		            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		            
		            // is the "remove after drop" checkbox checked?
		            if ($('#drop-remove').is(':checked')) {
		              // if so, remove the element from the "Draggable Events" list
		              $(this).remove();
		            }
		            
		          },
		         events: events
		      });
		    });
		    $('#myEvents').on('change', function(e, item){
		      addDragEvent($(item));
		    });
	
		    $('#myEvents li > div').each(function() {
		      addDragEvent($(this));
		    });
	
		    $(document).on('click', '#dayview', function() {
		      $('.calendar').fullCalendar('changeView', 'agendaDay')
		    });
	
		    $('#weekview').on('click', function() {
		      $('.calendar').fullCalendar('changeView', 'agendaWeek')
		    });
	
		    $('#monthview').on('click', function() {
		      $('.calendar').fullCalendar('changeView', 'month')
		    });
	
		  });
		}(window.jQuery);
	}
});