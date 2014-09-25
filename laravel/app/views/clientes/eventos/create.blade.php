@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Evento</h2>

{{ Form::open(array('route'=>'clientes_eventos.store','files'=>true)) }}

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', $estados->lists('estado','id'),null,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),null,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria','Subcategoria') }}
                  {{ Form::select('subcategoria', array(),null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre del evento', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('fecha_inicio', 'Fecha de inicio') }}      
                  <div class='input-group date' id='datetimepicker1' data-date-format="DD-MM-YYYY">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type='text' class="form-control" name="fecha_inicio" value="{{ Input::old('fecha_inicio') }}" placeholder="fecha de inicio" />
                  </div>                  
            </div>      
            <div class="col-sm-6">
                  {{ Form::label('fecha_fin', 'Fecha de finalización') }}      
                  <div class='input-group date' id='datetimepicker2' data-date-format="DD-MM-YYYY">
                        <input type='text' class="form-control" name="fecha_fin" value="{{ Input::old('fecha_fin') }}" placeholder="fecha de finalización" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('hora_inicio','Hora inicio') }}
                  <div class="input-group clockpicker" data-autoclose="true">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                        <input type="text" class="form-control" name="hora_inicio" value="{{ Input::old('hora_inicio')}}">
                  </div> 
            </div>
            <div class="col-sm-6">
                  {{ Form::label('hora_fin','Hora termino') }}
                  <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" class="form-control" name="hora_fin" value="{{ Input::old('hora_fin')}}">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                  </div> 
            </div>
      </div>
</div>        
<div class="form-group">
</div>
<div class="form-group">
      {{ Form::label('lugar', 'Lugar') }}
      {{ Form::text('lugar', Input::old('lugar'), array('placeholder' => 'lugar', 'class'=>'form-control')) }}
</div>  
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('moneda','Moneda') }}
                  {{ Form::select('moneda', array('MEX' => 'Pesos', 'USD' => 'Dólares'),null,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('costo','Costo') }}
                  {{ Form::text('costo', Input::old('costo'), array('placeholder' => '00.00', 'class'=>'form-control')) }}
            </div>            
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('min_edad','Edad mínima') }}
                  {{ Form::text('min_edad', Input::old('min_edad'), array('placeholder' => 'edad mínima', 'class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('max_edad','Edad máxima') }}
                  {{ Form::text('max_edad', Input::old('max_edad'), array('placeholder' => 'edad máxima', 'class'=>'form-control')) }}
            </div> 
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('alcohol',1) }}            
                              ¿Cuenta con alcohol?
                        </label>
                  </div>
            </div>
      </div>
</div>

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('pagos','Pagos Aceptados') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('tc', true) }}      
                              Tarjeta de crédito
                        </label>
                  </div>

            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('td', true) }}      
                              Tarjeta de debito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('efectivo', true) }}
                              Efectivo
                        </label>                        
                  </div>
            </div>
      </div>
</div>

<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Imágen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',Input::old('alt'),array('placeholder' => 'descripción', 'class'=>'form-control')) }}
            </div>      
      </div>
</div>


<div class="form-group">
      {{ Form::label('web', 'Página web') }}            
      {{ Form::text('web', Input::old('web') ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', Input::old('email') ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('mapa', 'Mapa') }}            
      {{ Form::hidden('mapa',Input::old('mapa'),array('id'=>'latlng')) }}

      {{ $mapa['html'] }}      
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
                              1 Mes
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="2">                               
                              {{ Form::radio('tiempo_publicacion',2) }}                       
                              2 Meses
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="3">                              
                              {{ Form::radio('tiempo_publicacion',3) }}                       
                              3 Meses
                        </label>
                  </div>
            </div>
            <div class="col-sm-3">
                  <div class="radio">
                        <label id="gratis">
                              {{ Form::radio('tiempo_publicacion',4) }}            
                              Gratis
                        </label>
                  </div>
            </div>

      </div>      
</div>
{{ Form::hidden('add_images',false,array('id'=>'addimg')) }}      


@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear evento</button>
      <button type="submit" class="btn btn-primary" onclick="$('#addimg').val('1')">Agregar imágenes</button>
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}

{{ $mapa['js'] }}
<script type="text/javascript">
      $(function() {
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
      $(document).ready(function() {
            $('#estados').change(function() {
                  var estado_id = $("#estados").val();
                  url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function(data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                              $("#zonas").append(elemento);
                        }
                  });
            }).trigger('change');

            $('#categorias').change(function() {
                  var categoria_id = $("#categorias").val();
                  url = base_url + "/obtener_subcategoria/" + categoria_id;
                  $.get(url).done(function(data) {
                        $("#subcats").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                              $("#subcats").append(elemento);
                        }
                  });
            }).trigger('change');
      });

</script>

<script>
      function save_map(event) {
            $('#latlng').val(event.latLng);
            createMarker_map(
                    {map: map, position: event.latLng}
            );
      }

</script>

<script type="text/javascript">
      $('.clockpicker').clockpicker();
</script>

<script>
      $("#1").click(function() {
            sumar_fecha(30);
      });
      $("#2").click(function() {
            sumar_fecha(60);
      });
      $("#3").click(function() {
            sumar_fecha(90);
      });
      $("#gratis").click(function() {
            sumar_fecha(15);
      });

      function sumar_fecha(dias) {            
            var day = moment($('#pub_ini').val(), "DD-MM-YYYY");
            
            day.add('days', dias);
            $('#pub_fin').val(day.format("DD-MM-YYYY"));
      }
</script>
@stop

