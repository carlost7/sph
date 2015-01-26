@extends('layouts.client_dashboard_master')

@section('content')

@if($promocion)
<h2>Editar: {{ $promocion->nombre }}</h2>

{{ Form::model($promocion, array('route' => array('publicar.clientes_promociones.update', $promocion->id), 'method' => 'PUT','files'=>true)) }}

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
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Editar imagen de promoción 250px * 250px') }}
                  {{ Form::file('imagen') }}
            </div>
      </div>
</div>
@if($editar_publicacion)
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('publicacion','Publicar contenido') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-12">
                  <label id="mod_pub">
                        {{ Form::checkbox('modificar_publicacion',true,false,array('id'=>'modificar_publicacion')) }} 
                        Modificar fechas de publicación
                  </label>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6 publicacion" >
                  {{ Form::label('publicacion_inicio', 'Inicio de publicación') }}
                  <div class='input-group date' id='datetimepicker3' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_inicio" value="{{ date('d-m-Y',strtotime($promocion->publicacion_inicio)) }}" id="pub_ini" placeholder="fecha de inicio de la publicación" />
                  </div>
            </div>
            <div class="col-sm-6 publicacion" >
                  {{ Form::label('publicacion_fin', 'Fin de la publicación') }}      
                  <div class='input-group date' id='datetimepicker4' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="publicacion_fin" value="{{ date('d-m-Y',strtotime($promocion->publicacion_fin)) }}" id="pub_fin" placeholder="fecha de finalización de la publicación" readonly="true"/>
                  </div>
            </div>
      </div>      
</div>
<div class="form-group" id="editar_publicacion">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('vigencia','Tiempo de la publicación') }}                  
            </div>
      </div>      

      <div class="row">
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="1" class="publicacion">
                              {{ Form::radio('tiempo_publicacion',1) }}            
                              7 dias
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="2" class="publicacion">                               
                              {{ Form::radio('tiempo_publicacion',2) }}                       
                              14 dias
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="3" class="publicacion">                              
                              {{ Form::radio('tiempo_publicacion',3) }}                       
                              30 dias
                        </label>
                  </div>
            </div>
      </div>      
</div>
@endif


@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar promoción</button>
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

<script>
      $('#datetimepicker1').datetimepicker({
            language: 'es',
            pickTime: false,
      })


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
      $(function() {
            $('.publicacion :input').attr('disabled', true);
      });

      $("#modificar_publicacion").click(function() {
            if ($('#modificar_publicacion').is(':checked')) {
                  $('.publicacion :input').attr('disabled', false);
            } else {
                  $('.publicacion :input').prop('disabled', true);
            }
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