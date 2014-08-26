@extends('layouts.client_dashboard_master')

@section('content')

@if($promocion)
<h2>Editar: {{ $promocion->nombre }}</h2>

{{ Form::model($promocion, array('route' => array('clientes_promociones.update', $promocion->id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">
      {{ Form::label('negocio','Negocio') }}
      {{ Form::select('negocio', $negocios->lists('nombre','id'),$promocion->negocio->id,array('class'=>'form-control','id'=>'negocios')) }}
</div>

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', $promocion->nombre, array('placeholder' => 'nombre de la promocion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('codigo', 'Código') }}
      {{ Form::text('codigo', $promocion->codigo, array('placeholder' => 'código de la promocion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', $promocion->descripcion, array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('vigencia_inicio', 'Vigencia inicio') }}      
      <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="vigencia_inicio" value="{{ date('d-m-Y H:i',strtotime($promocion->vigencia_inicio)) }}" placeholder="fecha de inicio" />
      </div>
</div>        
<div class="form-group">
      {{ Form::label('vigencia_fin', 'Vigencia fin') }}      
      <div class='input-group date' id='datetimepicker2' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="vigencia_fin" value="{{ date('d-m-Y H:i',strtotime($promocion->vigencia_fin)) }}" placeholder="fecha de finalización" />
      </div>
</div>
<div class="form-group">
      {{ Form::label('imagen','Imágen') }}
      <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
      @if($promocion->imagen)
      <div id="imagepreview" class="imagepreview" style="background-image: url({{ Config::get('params.path_public_image').$promocion->imagen->path.$promocion->imagen->nombre }})"></div>
      {{ Form::label('alt','Descripción') }}
      {{ Form::text('alt',$promocion->imagen->alt,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
      @else
      <div id="imagepreview" class="imagepreview"></div>
      {{ Form::label('alt','Descripción') }}
      {{ Form::text('alt',null,array('placeholder' => 'descripción', 'class'=>'form-control')) }}
      @endif
</div>


@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar evento</button>
</div>        

{{ Form::close() }}


@else
<h2>No seleccionó ninguna promoción para editar</h2>

@endif

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datepicker.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}

<script type="text/javascript">
      $(function() {
            $('#datetimepicker1').datetimepicker({
                  language: 'es',
                  pick12HourFormat: false

            });
      });
      $(function() {
            $('#datetimepicker2').datetimepicker({
                  language: 'es',
                  pick12HourFormat: false
            });
      });
</script>

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