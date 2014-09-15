@extends('layouts.webpage_master')

@section('wrapper')
<div class="col-sm-6 col-sm-push-3">
      <h2>Cambiar Password</h2>

      <form action="{{ action('RemindersController@postReset') }}" method="POST">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                  {{ Form::label('email', 'Correo Electrónico') }}
                  {{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('password', 'Password') }}
                  {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('password_confirmation', 'Repetir Password') }}
                  {{ Form::password('password_confirmation',array('placeholder' => 'Repetir password', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>                    
            </div>                
      </form>
</div>
@stop

