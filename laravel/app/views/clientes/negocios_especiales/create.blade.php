@extends('layouts.client_dashboard_master')

@section('content')

<h2>Agregar imagen</h2>

{{ Form::open(array('route'=>array('clientes_negocios_especiales.store','negocio_id'=>$negocio_id),'files'=>true)) }}

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Imagen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',Input::old('alt'),array('placeholder' => 'descripción', 'class'=>'form-control')) }}
            </div>      
      </div>
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Agregar imagen</button>
</div>        

{{ Form::close() }}

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

