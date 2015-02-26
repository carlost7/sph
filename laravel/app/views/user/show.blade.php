@extends('layouts.webpage_master')

@section('content')
<div class="row contenido_entrar">
      <div class="col-sm-6 col-sm-push-3">
            <h2>Entrar</h2>

            {{ Form::open(array('url' => 'login')) }}        
            <div class="form-group">
                  {{ Form::label('email', 'Correo Electrónico') }}
                  {{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>

            <div class="form-group">
                  {{ Form::label('password', 'Password') }}
                  {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Entrar</button>        
                  {{ HTML::linkAction('RemindersController@getRemind','Recuperar Password')}}
            </div>        
            {{ Form::close() }}

      </div>
</div>
@stop