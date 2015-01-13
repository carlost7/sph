@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Evento</h2>

@include('layouts.show_form_errors')

{{ Form::open(array('route'=>'publicar.clientes_eventos.store','files'=>true)) }}

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado_id','Estado') }}
                  {{ Form::select('estado_id', $estados->lists('estado','id'),null,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona_id','Zona') }}
                  {{ Form::select('zona_id', array(),null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria_id','Categoria') }}
                  {{ Form::select('categoria_id', $categorias->lists('categoria','id'),null,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria_id','Subcategoria') }}
                  {{ Form::select('subcategoria_id', array(),null,array('class'=>'form-control', 'id'=>'subcats')) }}
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
                        <input type='text' class="form-control" name="fecha_inicio" value="{{ Input::old('fecha_inicio') }}" placeholder="fecha de inicio" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
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
                        <input type="text" class="form-control" name="hora_inicio" value="{{ Input::old('hora_inicio')}}">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                  </div> 
            </div>
            <div class="col-sm-6">
                  {{ Form::label('hora_fin','Hora termino') }}
                  <div class="input-group clockpicker" data-autoclose="true">
                        <input      type="text" class="form-control" name="hora_fin" value="{{ Input::old('hora_fin')}}">
                        <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                        </span>
                  </div> 
            </div>
      </div>
</div>        
<div class="form-group">
      {{ Form::label('lugar', 'Lugar') }}
      {{ Form::text('lugar', Input::old('lugar'), array('placeholder' => 'lugar', 'class'=>'form-control')) }}
</div>  
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'id'=>'address','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('webpage', 'Página web') }}            
      {{ Form::text('webpage', Input::old('webpage') ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', Input::old('email') ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Agregar imagen de evento 250px * 250px') }}
                  {{ Form::file('imagen') }}
            </div>
      </div>
</div>
<div class="form-group">
      {{ Form::hidden('lat',Input::old('lat'),array('id'=>'map-lat')) }}
      {{ Form::hidden('long',Input::old('long'),array('id'=>'map-lng')) }}
      <button type="button" class=" btn btn-primary" onclick="searchPlace()">Usar campo dirección</button><div class="address_error" id="address_error"></div>
      <div id="map-canvas"></div>      
      <div id="transparente"></div>      
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
                              <input type="hidden" name="tc" value="0" />{{ Form::checkbox('tc', true) }} Tarjeta de crédito
                        </label>
                  </div>

            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="td" value="0" />{{ Form::checkbox('td', true) }}Tarjeta de debito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="efectivo" value="0" />{{ Form::checkbox('efectivo', true) }} Efectivo
                        </label>                        
                  </div>
            </div>
      </div>
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
                              {{ Form::radio('tiempo_publicacion',0) }}            
                              Gratis
                        </label>
                  </div>
            </div>

      </div>      
</div>






<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear evento</button>      
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/moment.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/vendor/bootstrap-datetimepicker.es.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}

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
      });</script>

<script>
      $(document).ready(function () {
            $('#estados').change(function () {
                  var estado_id = $("#estados").val();
                  url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function (data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                              $("#zonas").append(elemento);
                        }
                  });
            }).trigger('change');

            $('#categorias').change(function () {
                  var categoria_id = $("#categorias").val();
                  url = base_url + "/obtener_subcategoria/" + categoria_id;
                  $.get(url).done(function (data) {
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

<script type="text/javascript">
      $('.clockpicker').clockpicker();</script>

<script>
      $("#1").click(function () {
            sumar_fecha(30);
      });
      $("#2").click(function () {
            sumar_fecha(60);
      });
      $("#3").click(function () {
            sumar_fecha(90);
      });
      $("#gratis").click(function () {
            sumar_fecha(15);
      });
      function sumar_fecha(dias) {
            var day = moment($('#pub_ini').val(), "DD-MM-YYYY");
            day.add('days', dias);
            $('#pub_fin').val(day.format("DD-MM-YYYY"));
      }
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
              var map;
              var markers = [];
              function initialize() {

              var mapOptions = {
              center: {lat: 19.43938462939674, lng: - 99.13208094891161},
                      zoom: 16
              };
                      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
<?php
if (Input::old('lat') == null || Input::old('long') == null)
{
      ?>
                    // Try HTML5 geolocation
                    if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                    pos = new google.maps.LatLng(position.coords.latitude,
                            position.coords.longitude);
                            map.setCenter(pos);
                    }, function () {
                    handleNoGeolocation(true);
                    });
                    } else {
                    // Browser doesn't support Geolocation
                    handleNoGeolocation(false);
                    }
      <?php
}
else
{
      ?>
                    var lat = {{Input::old('lat')}};
                            var lng = {{Input::old('long')}};
                            pos = new google.maps.LatLng(lat, lng);
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                            position: pos,
                                    map: map
                            });
      <?php
}
?>

              google.maps.event.addListener(map, 'click', function (event) {
              placeMarker(event.latLng);
              });
              }

      function placeMarker(location) {
      $("#map-lat").val(location.lat());
              $("#map-lng").val(location.lng());
              if (markers.length){
      markers[0].setMap(null);
              markers = [];
      }

      var marker = new google.maps.Marker({
      position: location,
              map: map
      });
              markers.push(marker);
              map.setCenter(location);
      }

      function searchPlace(){

      geocoder = new google.maps.Geocoder();
              $("#address_error").html("");
              var address = $('#address').val();
              geocoder.geocode({ 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
              //In this case it creates a marker, but you can get the lat and lng from the location.LatLng
              map.setCenter(results[0].geometry.location);
              } else {
              $("#address_error").html("no se encontró ningún lugar");
              }
              });
      }


      google.maps.event.addDomListener(window, 'load', initialize);


</script>



@stop

