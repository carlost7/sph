@extends('layouts.webpage_master')

@section('content')
<div class="row">
      <div class="col-sm-6 col-sm-push-3">
            <h2>Registrar nuevo usuario</h2>
            {{ Form::open(array('route' => 'user.register')) }}
            <div class="form-group">
                  {{ Form::label('nombre', 'Nombre') }}
                  {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('email', 'Correo electrónico') }}
                  {{ Form::text('email', Input::old('correo'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>        
            <div class="form-group">
                  {{ Form::label('telefono', 'Teléfono') }}
                  {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'telefono', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('password', 'Password') }}
                  {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('password_confirmation', 'Confirmar password') }}
                  {{ Form::password('password_confirmation',array('placeholder' => 'repetir password', 'class'=>'form-control')) }}
            </div>

            @include('layouts.show_form_errors');

            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Registrar</button>
            </div>        
            {{ Form::close() }}
      </div>
</div>
@stop