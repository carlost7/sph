@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'publicar.clientes_negocios.store')) }}

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre del negocio', 'class'=>'form-control')) }}
</div>
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
      <button type="submit" class="btn btn-primary">Crear negocio</button>
</div>        

{{ Form::close() }}


@stop