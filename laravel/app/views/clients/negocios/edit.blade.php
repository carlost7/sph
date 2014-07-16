@extends('layouts.client_dashboard_master')

@section('content')

@if($negocio)
<h2>Editar: {{ $negocio->nombre }}</h2>

{{ Form::model($negocio, array('route' => array('clientes_negocios.update', $negocio->id), 'method' => 'PUT')) }}

<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'telefono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar negocio</button>
</div>        

{{ Form::close() }}


@else
<h2>No seleccionó ningún negocio para editar</h2>

@endif
<h2></h2>

@stop