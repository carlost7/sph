@extends('layouts.webpage_master')

@section('wrapper')
<div class="row contenido_entrar">
      <div class="col-sm-6 col-sm-push-3 form_login">
          <h2 class="title_login padding_especial"><span>Entrar</span></h2>

            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ Session::get('message') }}
                  {{ Session::forget('message'); }}        
            </div>                        
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  {{ Session::get('error') }}
                  {{ Session::forget('error'); }}
            </div>                    
            @endif

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
            
            <div class="form-group btn_espacio">
                  <button type="submit" class="btn btn-primary btn_acceso">Entrar</button>        
                  {{ HTML::linkAction('RemindersController@getRemind','Recuperar Password', null, array('class'=>'recover_pass')) }}
                  
                  
              
                  
                  
                  
                
                  
                  
            </div>                        
            {{ Form::close() }}

      </div>
</div>

<div class="row" style="display:none">
      <div class="col-sm-6 col-sm-push-3">
            <div class="form-group">
                  <h2>Accede con nuestras redes sociales</h2>
                  {{ HTML::LinkRoute('session.authorise','Twitter','twitter',array('class'=>'btn btn-info')) }}
                  
                  {{ HTML::LinkRoute('session.authorise','Fcebook','facebook',array('class'=>'btn btn-info')) }}
                  
                  {{ HTML::LinkRoute('session.authorise','Google Plus','google',array('class'=>'btn btn-info')) }}
            </div>
      </div>
      
</div>
@stop