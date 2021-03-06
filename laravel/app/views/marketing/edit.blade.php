@extends('layouts.marketing_dashboard_master')

@section('content')

<h2>Editar Cuenta</h2>


{{ Form::open(array('route'=>'marketing.update')) }}

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Auth::user()->userable->nombre, array('placeholder' => 'nombre', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}
      {{ Form::text('email', Auth::user()->email, array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
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
      <button type="submit" class="btn btn-primary">Editar</button>
</div>        


{{ Form::close()}}




@stop