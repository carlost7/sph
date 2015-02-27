@extends('layouts.webpage_master')

@section('wrapper')
<div class="row contenido_entrar_registrer">
      <div class="col-sm-6 col-sm-push-3  form_login">
          <h2 class="title_login_dos padding_especial"><span>Nuevo Usuario</span></h2>
            {{ Form::open(array('route' => 'register.store_user')) }}
            <div class="form-group">
                  {{ Form::label('username', 'Nombre de usuario') }}
                  {{ Form::text('username', Input::old('username'), array('placeholder' => 'nombre de usuario', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('email', 'Correo electrónico') }}
                  {{ Form::text('email', Input::old('correo'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>                        
            <div class="form-group">
                  {{ Form::label('password', 'Password') }}
                  {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('password_confirmation', 'Confirmar password') }}
                  {{ Form::password('password_confirmation',array('placeholder' => 'repetir password', 'class'=>'form-control')) }}
            </div>

            @include('layouts.show_form_errors')

            <div class="form-group">
                  <button type="submit" class="btn btn-primary btn_acceso">Registrar</button>
            </div>        
            {{ Form::close() }}
      </div>
</div>
<div class="container" style="display:none">
      <div class="row">
            <div class="col-sm-4">
                  <div class="form-group">
                        {{ HTML::LinkRoute('authenticate.authorise','Registrate con Twitter','twitter',array('class'=>'btn btn-info')) }}
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="form-group">
                        {{ HTML::LinkRoute('authenticate.authorise','Registrate con Facebook','facebook',array('class'=>'btn btn-info')) }}
                  </div>
            </div>
      </div>      
</div>
@stop