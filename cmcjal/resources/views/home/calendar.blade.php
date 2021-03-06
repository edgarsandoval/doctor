@extends('layouts.main')

@section('content')
	<header class="page-header">
		<h2>Calendario</h2>

		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="{{ route('admin.index') }}">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Calendario</span></li>
			</ol>

			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>

	<!-- start: page -->
	<div class="panel panel-default">
	<!-- Content Header (Page header) -->
	<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>

			</div>

				<h2 class="panel-title"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;Eventos</h2>

		</header>
	<div class="panel-body">
	<!-- Main content -->
	<section class="content">
		<div class="row">
		@if(Auth::user()->type == 1)
		<div class="col-md-3">
			<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title">Eventos sin agendar</h4>
			</div>
			<div class="box-body">
				<!-- the events -->
				<div id="external-events">
					<div class="external-event bg-green">Evento 1</div>
					<div class="external-event bg-yellow">Evento 2</div>
					<div class="external-event bg-aqua">Evento 3</div>
					<div class="external-event bg-light-blue">Evento 4</div>
				</div>
			</div>
			<!-- /.box-body -->
			</div>
			<!-- /. box -->
			<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Crear evento</h3>
			</div>
			<div class="box-body">
				<div class="btn-group" style="width: 100%; margin-bottom: 10px;">
				<!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
				<ul class="fc-color-picker" id="color-chooser">
					<li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
					<li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
				</ul>
				</div>
				<!-- /btn-group -->
				<div class="input-group">
				<input id="new-event" type="text" class="form-control" placeholder="Título">

				<div class="input-group-btn">
					<button id="add-new-event" type="button" class="btn btn-primary btn-flat">Agregar</button>
				</div>
				<!-- /btn-group -->
				</div><br/><br/>
				<!-- /input-group -->
			  	{!! Form::open(['route' => ['events.create'], 'method' => 'POST', 'id' =>'form-calendario']) !!}
			  	{!! Form::close() !!}
			</div>
			</div>
		</div>
		@endif
		<!-- /.col -->
		<div class="{{ Auth::user()->type == 1 ? 'col-md-9' : 'col-md-10 col-md-offset-1' }}">
			<div class="box box-primary">
			<div class="box-body no-padding">
				<!-- THE CALENDAR -->
				<div id="calendar"></div>
			</div>
			<!-- /.box-body -->
			</div>
			<!-- /. box -->
		</div>
		<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
	 </div><!-- /.panel-body -->
	</div><!-- /.panel -->
@endsection

@section('pageHeader')
<header class="page-header">
	<h2>Perfil de Usuario</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="{{ route('admin.index') }}">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Perfil de Usuario</span></li>
		</ol>

		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>
@endsection

@section('scripts')
<script>
	$(function () {
		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				color: $(this).css('background-color'),
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,		// will cause the event to go back to its
				revertDuration: 0	//	original position after the drag
			});

		});

		/* initialize the calendar
		 -----------------------------------------------------------------*/
		//Date for the calendar events (dummy data)

		/*var todayDate = moment().startOf('day');
		var YM = todayDate.format('YYYY-MM');
		var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
		var TODAY = todayDate.format('YYYY-MM-DD');
		var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');*/

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month, agendaWeek, agendaDay, listWeek'
			},
			editable: true,
			droppable: true,	// this allows things to be dropped onto the calendar !!!
			eventLimit: true, // allow "more" link when too many events
			navLinks: true,
			events: { url : '{{ route('events.all') }}'},
			timeFormat: 'h:mm',
			drop : function(date, jsEvent, ui, resourceId) {
				// Remove the element from the "Draggable Events" list
				$(this).remove();
			},

			eventReceive : function(event) {
				var data = {
					title 	: event.title,
				 	start	: event.start.format(),
				 	end		: (event.end ? event.end.format() : null),
				 	color 	: event.color,
				 	allDay	: event.allDay
				};

				crsfToken = document.getElementsByName("_token")[0].value;

				$.ajax({
					url: '{{ route('events.create') }} ',
					data: data,
					type: "POST",
					headers: {
						"X-CSRF-TOKEN": crsfToken
					},
					success: function(response) {
						event.id = response;
						console.log('Evento creado');
					},
					error: function() {
						console.log("Error al crear evento");
					}
				});
			},
			eventResize: function(event, delta, revertFunc) {
				if (!confirm('¿Es correcto a las ' + event.end.format() + '?')) {
					revertFunc();
					return;
				}

				var data = {
					id 		: event.id,
					title 	: event.title,
				 	start	: event.start.format(),
				 	end		: (event.end ? event.end.format() : null),
				 	color 	: event.color,
				 	allDay	: event.allDay
				};

				crsfToken = document.getElementsByName("_token")[0].value;

				$.ajax({
					url: '{{ route('events.update') }}',
					data: data,
					type: "POST",
					headers: {
						"X-CSRF-TOKEN": crsfToken
					},
					success: function() {
						console.log("Updated Successfully");
					},
					error: function(){
						console.log("Error al actualizar evento");
					}
				});
			},
			eventDrop: function(event, delta, revertFunc) {
				if (!confirm('¿Es correcto a las ' + event.start.format() + '?')) {
					revertFunc();
					return;
				}

				var data = {
					id 		: event.id,
					title 	: event.title,
				 	start	: event.start.format(),
				 	end		: (event.end ? event.end.format() : null),
				 	color 	: event.color,
				 	allDay	: event.allDay
				};

				crsfToken = document.getElementsByName("_token")[0].value;

				$.ajax({
					url: '{{ route('events.update') }}',
					data: data,
					type: "POST",
					headers: {
					  "X-CSRF-TOKEN": crsfToken
					},
					success: function() {
					  console.log("Updated Successfully eventdrop");
					},
					error: function(){
					  console.log("Error al actualizar eventdrop");
					}
				});
	  		},
	  		eventClick: function(calEvent, jsEvent, view) {
	  		 	var url = '{{ route('events.show', ':EVENT_ID') }}';
	  		 		url = url.replace(':EVENT_ID', calEvent.id);
	  		 	window.location.href = url;
			}
		});

		/* AGREGANDO EVENTOS AL PANEL */
		var currColor = "#3c8dbc"; //Red by default
		//Color chooser button
		var colorChooser = $("#color-chooser-btn");
		$("#color-chooser > li > a").click(function (e) {
			e.preventDefault();
			//Save color
			currColor = $(this).css("color");
			//Add color effect to button
			$('#add-new-event').css({"background-color": currColor, "border-color": currColor});
		});

		$("#add-new-event").click(function (e) {
			e.preventDefault();
			//Get value and make sure it is not null
			var val = $("#new-event").val();
			if (val.length == 0)
				return;

			//Create events
			var event = $("<div />");
			event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
			event.html(val);
			$('#external-events').prepend(event);

			//Add draggable funtionality
			event.data('event', {
				title: val, // use the element's text as the event title
				color: currColor,
				stick: true // maintain when user navigates (see docs on the renderEvent method),
			});

			// make the event draggable using jQuery UI
			event.draggable({
				zIndex: 999,
				revert: true,		// will cause the event to go back to its
				revertDuration: 0	//	original position after the drag
			});

			//Remove event from text input
			$("#new-event").val("");
		});
	});
</script>
@endsection
