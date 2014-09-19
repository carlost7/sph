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
@if($miembro->user->password)
<div class="form-group">
      {{ Form::label('password', 'Contraseña*') }}
      {{ Form::password('password',array('placeholder' => 'password', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('password_confirm', 'Confirmar contraseña*') }}
      {{ Form::password('password_confirm',array('placeholder' => 'repetir password', 'class'=>'form-control')) }}
</div>
@endif

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Perfil') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  @if($miembro->imagen)
                  <div id="imagepreview" class="profile_image imagepreview" style="background-image: url({{ Config::get('params.path_public_image').$miembro->imagen->path.$miembro->imagen->nombre }})"></div>
                  @else
                  <div id="imagepreview" class="profile_image imagepreview" style="background-image: url('{{URL::to("/")}}/img/profile_default.png')"></div>
                  @endif
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

{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
<script>
      $('.file-inputs').bootstrapFileInput();

      $(function() {
            $('#uploadFile').on("change", function() {
                  var files = !!this.files ? this.files : [];
                  if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                  if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function() { // set image data as background of div
                              $("#imagepreview").css("background-image", "url(" + this.result + ")");
                        }
                  }
            });
      });

      $("#cambiar_username").click(function() {
            if ($("#cambiar_username").is(':checked')) {
                  $("#username").attr('disabled', false);
            } else {
                  $("#username").prop('disabled', true);
            }
      });
</script>
@stop