@extends('layouts.client_dashboard_master')

@section('content')

@if($pago)
<h2>Editar: {{ $pago->nombre }}</h2>

{{ Form::model($pago, array('route' => array('clientes_pagos.update', $pago->id), 'method' => 'PUT')) }}

<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', $pago->descripcion, array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', $pago->direccion, array('placeholder' => 'direccion de evento', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('inicio', 'Inicio') }}      
      <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="inicio" value="{{ date('d-m-Y H:i',strtotime($pago->inicio)) }}" placeholder="fecha de inicio" />
      </div>
</div>        
<div class="form-group">
      {{ Form::label('fin', 'Fin') }}      
      <div class='input-group date' id='datetimepicker2' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="fin" value="{{ date('d-m-Y H:i',strtotime($pago->fin)) }}" placeholder="fecha de finalización" />
      </div>
</div>
@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar evento</button>
</div>        

{{ Form::close() }}


@else
<h2>No seleccionó ningún negocio para editar</h2>

@endif

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datepicker.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}

<script type="text/javascript">
      $(function() {
            $('#datetimepicker1').datetimepicker({
                  language: 'es',
                  pick12HourFormat: false

            });
      });
      $(function() {
            $('#datetimepicker2').datetimepicker({
                  language: 'es',
                  pick12HourFormat: false
            });
      });
</script>

@stop