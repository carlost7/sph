@extends('layouts.miembro_dashboard_master')

@section('content')

@if($miembro)
<h2>Editar: {{ $miembro->username }}</h2>

{{ Form::model($miembro, array('route' => array('miembros.update', $miembro->id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">
      {{ Form::label('username', 'Nombre de usuario') }}
      {{ Form::text('username', $miembro->username, array('placeholder' => 'nombre de usuario', 'class'=>'form-control','id'=>'username','disabled'=>'disabled')) }}
      <div class="checkbox">
            <label>
                  {{ Form::checkbox('cambiar','cambiar',false,array('id'=>'cambiar_username')) }}
                  Cambiar nombre de usuario
            </label>                        
      </div>
</div>
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}
      {{ Form::text('email',$miembro->user->email,array('placeholder' => 'correo electrónico', 'class'=>'form-control')) }}
</div>
@if($miembro->user->password)
<div class="form-group">
      {{ Form::label('password', 'Contraseña') }}
      {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('password_confirm', 'Confirmar contraseña') }}
      {{ Form::password('password_confirm',array('placeholder' => 'repetir password', 'class'=>'form-control')) }}
</div>
@endif

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  @if($miembro->avatar_file_name != "")
                  <img src="{{ URL::to("/").$miembro->avatar->url('medium') }}">
                  @endif
                  {{ Form::label('avatar','Editar imagen de negocio 250px * 250px') }}
                  {{ Form::file('avatar') }}
            </div>
      </div>
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar usuario</button>
</div>        

{{ Form::close() }}


@else
<h2>No existe el usuario a editar</h2>

@endif

@stop

@section('scripts')

<script>
      $("#cambiar_username").click(function () {
            if ($("#cambiar_username").is(':checked')) {
                  $("#username").attr('disabled', false);
            } else {
                  $("#username").prop('disabled', true);
            }
      });
</script>
@stop