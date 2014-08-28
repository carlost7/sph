@extends('layouts.client_dashboard_master')

@section('content')

<h2>Editar Imagen</h2>

@if($imagen)
{{ Form::open(array('route' => array('clientes_negocios_especiales.destroy','id'=>$imagen->id,'negocio_id'=>$negocio_id))) }} 
{{ Form::hidden('_method', 'DELETE') }}            
<p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-primary')) }}</p>
{{ Form::close() }}                        


{{ Form::model($imagen, array('route' => array('clientes_negocios_especiales.update', 'id'=>$imagen->id,'negocio_id'=>$negocio_id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">      
      {{ Form::label('imagen','Imágen') }}
      <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">      
      <div id="imagepreview" class="imagepreview" style="background-image: url({{ Config::get('params.path_public_image').$imagen->path.$imagen->nombre }})"></div>
      {{ Form::label('alt','Descripción') }}
      {{ Form::text('alt',$imagen->alt,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
</div>      


@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar imagen</button>
</div>      

{{ Form::close() }}




@else
<h2>No seleccionó ninguna imagen para editar</h2>

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
</script>

@stop