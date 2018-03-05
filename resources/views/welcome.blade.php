<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>fullCalendar and Laravel 5.3</title>
        {!! Html::style('vendor/seguce92/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('vendor/seguce92/fullcalendar/fullcalendar.min.css') !!}
        {!! Html::style('vendor/seguce92/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}
        {!! Html::style('vendor/seguce92/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}
    </head>
    <body>
        <div class="container">

            {{ Form::open(['route' => 'events.store', 'method' => 'post', 'role' => 'form']) }}
            <div id="responsive-modal" class="modal fade" tabindex="-1" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>REGISTRO DE NUEVO EVENTO</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('title', 'TITULO DE EVENTO') }}
                                {{ Form::text('title', old('title'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('date_start', 'FECHA INICIO') }}
                                {{ Form::text('date_start', old('date_start'), ['class' => 'form-control', 'readonly' => 'true']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('time_start', 'HORA INICIO') }}
                                {{ Form::text('time_start', old('time_start'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('date_end', 'FECHA HORA FIN') }}
                                {{ Form::text('date_end', old('date_end'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('color', 'COLOR') }}
                                <div class="input-group colorpicker">
                                    {{ Form::text('color', old('color'), ['class' => 'form-control']) }}
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dafault" data-dismiss="modal">CANCELAR</button>
                            {!! Form::submit('GUARDAR', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <div id='calendar'></div>

            <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>DETALLES DE EVENTO</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('_title', 'TITULO DE EVENTO') }}
                                {{ Form::text('_title', old('_title'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_date_start', 'FECHA INICIO') }}
                                {{ Form::text('_date_start', old('_date_start'), ['class' => 'form-control', 'readonly']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_time_start', 'HORA INICIO') }}
                                {{ Form::text('_time_start', old('_time_start'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_date_end', 'FECHA HORA FIN') }}
                                {{ Form::text('_date_end', old('_date_end'), ['class' => 'form-control']) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('_color', 'COLOR') }}
                                <div class="input-group colorpicker">
                                    {{ Form::text('_color', old('_color'), ['class' => 'form-control']) }}
                                    <span class="input-group-addon">
                                        <i></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a id="delete" data-href="{{ url('events') }}" data-id="" class="btn btn-danger">ELIMINAR</a>
                            <button type="button" class="btn btn-dafault" data-dismiss="modal">CANCELAR</button>
                            <a href="#" data-href="{{ url('events') }}" class="btn btn-success btn-update" data-id="">ACTUALIZAR</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
    {!! Html::script('vendor/seguce92/jquery.min.js') !!}
    {!! Html::script('vendor/seguce92/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('vendor/seguce92/fullcalendar/lib/moment.min.js') !!}
    {!! Html::script('vendor/seguce92/fullcalendar/fullcalendar.min.js') !!}
    {!! Html::script('vendor/seguce92/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}
    {!! Html::script('vendor/seguce92/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
    <script>
        var BASEURL = "{{ url('/') }}";
        $(document).ready(function() {

    		$('#calendar').fullCalendar({
    			header: {
    				left: 'prev,next today',
    				center: 'title',
    				right: 'month,basicWeek,basicDay'
    			},
    			navLinks: true, // can click day/week names to navigate views
    			editable: true,
                selectable: true,
                selectHelper: true,

                select: function(start){
                    start = moment(start.format());
                    $('#date_start').val(start.format('YYYY-MM-DD'));
                    $('#responsive-modal').modal('show');
                },

    			events: BASEURL + '/events',

                eventClick: function(event, jsEvent, view){
                    var date_start = $.fullCalendar.moment(event.start).format('YYYY-MM-DD');
                    var time_start = $.fullCalendar.moment(event.start).format('hh:mm:ss');
                    var date_end = $.fullCalendar.moment(event.end).format('YYYY-MM-DD hh:mm:ss');
                    $('#modal-event #delete').attr('data-id', event.id);
                    $('#modal-event .btn-update').attr('data-id', event.id);
                    $('#modal-event #_title').val(event.title);
                    $('#modal-event #_date_start').val(date_start);
                    $('#modal-event #_time_start').val(time_start);
                    $('#modal-event #_date_end').val(date_end);
                    $('#modal-event #_color').val(event.color);
                    $('#modal-event').modal('show');
                }
    		});

    	});

        $('.colorpicker').colorpicker();

        $('#time_start').bootstrapMaterialDatePicker({
            date: false,
            shortTime: false,
            format: 'HH:mm:ss'
        });

        $('#date_end').bootstrapMaterialDatePicker({
            date: true,
            shortTime: false,
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('#_time_start').bootstrapMaterialDatePicker({
            date: false,
            shortTime: false,
            format: 'HH:mm:ss'
        });

        $('#_date_end').bootstrapMaterialDatePicker({
            date: true,
            shortTime: false,
            format: 'YYYY-MM-DD HH:mm:ss'
        });

        $('#delete').on('click', function(){
            var x = $(this);
            var delete_url = x.attr('data-href')+'/'+x.attr('data-id');

            $.ajax({
                url: delete_url,
                type: 'DELETE',
                success: function(result){
                    $('#modal-event').modal('hide');
                    alert(result.message);
                    location.reload(true);//recarga de pagina
                },
                error: function(result){
                    $('#modal-event').modal('hide');
                    alert(result.message);
                }
            });
        });

        $(document).on('click', '.btn-update', function () {
            // Creamos un objeto de tipo FormData de Jquery para enviar los valores recuperados del evento
            
            var route_update = $(this).attr('data-href') + '/' + $(this).attr('data-id'); //recuperamos la ruta & id del evento
            var data = {
                'date_start': $('#_date_start').val(),
                'title':$('#_title').val(),
                'time_start': $('#_time_start').val(),
                'date_end': $('#_date_end').val(),
                'color': $('#_color').val(),
                '_method': 'PATCH'
            };
            $.ajax({
                data: data,
                type: 'PATCH',
                url: route_update,
                success: function(result) {
                    $('#modal-event').modal('hide');
                    if(result.status === 201){ //comprobamos si se actualizo de forma correcto
                        alert(result.message);
                        location.reload(true); //forzamos la recarga de la pagina
                    }
                    else
                        alert(result.message);
                },
                error: function() {
                    $('#modal-event').modal('hide');
                    alert('ERROR AL ACTUALIZAR EVENTO');
                }
            });
        });

    </script>
</html>
