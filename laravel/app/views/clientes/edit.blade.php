@extends('layouts.client_dashboard_master')

@section('content')

<h2>Editar Cuenta</h2>


{{ Form::model($cliente, array('route'=>'publicar.cliente.update')) }}

<div class="row">
      <div class="form-group col-sm-6">
            {{ Form::label('nombre', 'Nombre*') }}
            {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre', 'class'=>'form-control')) }}
      </div>
      <div class="form-group col-sm-6">
            {{ Form::label('apellido', 'Apellido*') }}
            {{ Form::text('apellido', Input::old('apellido'), array('placeholder' => 'apellido', 'class'=>'form-control')) }}
      </div>
</div>
<div class="form-group">
      {{ Form::label('empresa', 'Empresa') }}
      {{ Form::text('empresa', Input::old('empresa'), array('placeholder' => 'empresa', 'class'=>'form-control')) }}
</div>
<div class="row">
      <div class="form-group col-sm-3">
            {{ Form::label('ext', 'Ext.') }}
            {{ Form::text('ext', Input::old('ext'), array('placeholder' => 'ext', 'class'=>'form-control')) }}
      </div>
      <div class="form-group col-sm-9">
            {{ Form::label('telefono', 'Teléfono*') }}
            {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'telefono', 'class'=>'form-control')) }}
      </div>
</div>
<div class="form-group">
      {{ Form::label('celular', 'Celular*') }}
      {{ Form::text('celular', Input::old('celular'), array('placeholder' => 'celular', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico*') }}
      {{ Form::text('email', Auth::user()->email, array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('password', 'Password*') }}
      {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('password_confirm', 'Confirmar password*') }}
      {{ Form::password('password_confirm',array('placeholder' => 'repetir password', 'class'=>'form-control')) }}
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar</button>
</div>        


{{ Form::close()}}




@stop