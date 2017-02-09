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
                                {{ Form::label('title', 'FECHA INICIO') }}
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

    			events: BASEURL + '/events'
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

    </script>
</html>
