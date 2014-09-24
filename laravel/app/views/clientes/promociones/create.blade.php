@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Promociones</h2>

@if($negocios->count())
{{ Form::open(array('route'=>'clientes_promociones.store','files'=>true)) }}

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
      {{ Form::label('vigencia_inicio', 'Inicio') }}      
      <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY HH:mm">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            <input type='text' class="form-control" name="vigencia_inicio" value="{{ Input::old('vigencia_inicio') }}" id="vig_ini" placeholder="fecha de inicio" />
      </div>
</div>        
<div class="form-group">
      {{ Form::label('vigencia','Vigencia de la promoción') }}
      <div class="row">
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="semana">
                              {{ Form::radio('tiempo_promo',1) }}            
                              Semana
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="quincena">                               
                              {{ Form::radio('tiempo_promo',2) }}                       
                              Quincena
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="mes">                              
                              {{ Form::radio('tiempo_promo',3) }}                       
                              Mes
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label>
                              {{ Form::radio('tiempo_promo',4,true) }}            
                              Manual
                        </label>
                  </div>
            </div>

      </div>      
</div>
<div class="form-group">
      {{ Form::label('vigencia_fin', 'Fin') }}      
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

<script>
      $("#semana").click(function() {
            sumar_fecha(7);
      });
      $("#quincena").click(function() {
            sumar_fecha(15);
      });
      $("#mes").click(function() {
            sumar_fecha(30);
      });
      
      function sumar_fecha(dias){
            var day = moment($('#vig_ini').val(),"DD-MM-YYYY HH:mm");
            
            day.add('days',dias);
            $('#vig_fin').val(day.format("DD-MM-YYYY HH:mm"));
      }
      
</script>
@stop

