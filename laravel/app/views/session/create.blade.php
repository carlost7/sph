@extends('layouts.webpage_master')

@section('wrapper')
<div class="row">
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
                  <div class="checkbox">
                        <label>
                              <input type="checkbox" name="rememberme" value="1"> Seguir conectado
                        </label>
                  </div>
            </div>                  
            @if (Session::has('login_errors'))
            <div class="alert alert-danger">Correo o Password Incorrecto</div>
            @endif                
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Entrar</button>        
                  {{ HTML::linkAction('RemindersController@getRemind','Recuperar Password')}}
            </div>                        
            {{ Form::close() }}

      </div>
</div>
@stop