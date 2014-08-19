@extends('layouts.admin_dashboard_master')

@section('content')

<h2>Editar Cuenta</h2>


{{ Form::model($administrador, array('route'=>'administradores.update')) }}


<div class="form-group">
      {{ Form::label('nombre', 'Nombre*') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre', 'class'=>'form-control')) }}
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