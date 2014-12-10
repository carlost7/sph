@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Promociones</h2>

@if($negocios->count())
{{ Form::open(array('route'=>'publicar.clientes_promociones.store','files'=>true)) }}

<div class="form-group">
      {{ Form::label('negocio','Negocio') }}
      {{ Form::select('negocio', $negocios->lists('nombre','id'),null,array('class'=>'form-control','id'=>'negocios')) }}
</div>

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre de la promocion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('codigo', 'Código') }}
      {{ Form::text('codigo', Input::old('codigo'), array('placeholder' => 'código de la promocion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('vigencia_inicio', 'Vigencia de la promoción (inicio)') }}      
      <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="vigencia_inicio" value="{{ Input::old('vigencia_inicio') }}" id="vig_ini" placeholder="fecha de inicio" />
      </div>
</div>        
<div class="form-group">
      {{ Form::label('vigencia_fin', 'Vigencia de la promoción (fin)') }}      
      <div class='input-group date' id='datetimepicker2' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="vigencia_fin" value="{{ Input::old('vigencia_fin') }}" id="vig_fin" placeholder="fecha de finalización" />
      </div>
</div>
<div class="form-group">

      {{ Form::label('imagen','Imágen') }}
      <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
      <div id="imagepreview" class="imagepreview"></div>
      {{ Form::label('alt','Texto alternativo') }}
      {{ Form::text('alt',Input::old('alt'),array('placeholder' => 'Texto alternativo', 'class'=>'form-control')) }}

</div>

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('publicacion','Publicar contenido') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('publicacion_inicio', 'Inicio de publicación') }}
                  <div class='input-group date' id='datetimepicker3' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_inicio" value="{{ Input::old('publicacion_inicio') }}" id="pub_ini" placeholder="fecha de inicio de la publicación" />
                  </div>
            </div>
            <div class="col-sm-6">
                  {{ Form::label('publicacion_fin', 'Fin de la publicación') }}      
                  <div class='input-group date' id='datetimepicker4' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_fin" value="{{ Input::old('publicacion_fin') }}" id="pub_fin" placeholder="fecha de finalización de la publicación" readonly="true"/>
                  </div>
            </div>
      </div>      
</div>        
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('vigencia','Vigencia de la publicación') }}
                  <p>Elige el tiempo en que quieres que tu publicación este activa en la página, si eliges la publicación gratuita solo podrá mostrarse 2 semanas y los miembros no tendran posibilidad de ver el mapa o darle like a tu evento</p>
            </div>
      </div>      
      <div class="row">
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="1">
                              {{ Form::radio('tiempo_publicacion',1) }}            
                              7 dias
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="2">                               
                              {{ Form::radio('tiempo_publicacion',2) }}                       
                              15 dias
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="3">                              
                              {{ Form::radio('tiempo_publicacion',3) }}                       
                              30 dias
                        </label>
                  </div>
            </div>
      </div>      
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear promocion</button>
</div>        

{{ Form::close() }}

@else

<h3>No tienes ningún negocio al que se le pueda agregar una promoción</h3>

@endif

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datepicker.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}

<script type="text/javascript">
      $('#datetimepicker1').datetimepicker({
            language: 'es',
            pickTime: false,

      });
      $('#datetimepicker2').datetimepicker({
            language: 'es',
            pickTime: false,
      });

      $('#datetimepicker3').datetimepicker({
            language: 'es',
            pickTime: false,
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

<script>
      $("#1").click(function() {
            sumar_fecha(7);
      });
      $("#2").click(function() {
            sumar_fecha(14);
      });
      $("#3").click(function() {
            sumar_fecha(30);
      });

      function sumar_fecha(dias) {
            var day = moment($('#pub_ini').val(), "DD-MM-YYYY");
            
            day.add('days', dias);
            $('#pub_fin').val(day.format("DD-MM-YYYY"));
      }

</script>
@stop

