@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'publicar.clientes_negocios.store', 'files'=>true)) }}

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
                  {{ Form::label('subcategoria_id','subcategoria') }}
                  {{ Form::select('subcategoria_id', array(),null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre del negocio', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'class'=>'form-control','id'=>'address')) }}
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
                  <div class="row">
                        <div class="col-sm-12">
                              {{ Form::label('horario','Horarios') }}
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("lun",1,(Input::old('lun_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'lun')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_ini','Lunes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="lun_ini" id="ini" value="{{ (Input::old('lun_ini') == null)?"":date('H:i',strtotime(Input::old('lun_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_fin','Lunes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="lun_fin" id="fin" value="{{ (Input::old('lun_fin') == null)?"":date('H:i',strtotime(Input::old('lun_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("mar",1,(Input::old('mar_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'mar')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_ini','Martes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="mar_ini" value="{{ (Input::old('lun_ini') == null)?"":date('H:i',strtotime(Input::old('lun_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_fin','Martes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="mar_fin" value="{{ (Input::old('mar_fin') == null)?"":date('H:i',strtotime(Input::old('mar_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("mie",1,((Input::old('mie_ini') == "00:00:00"))?true:false,array('class'=>'desactivar','id'=>'mie')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_ini','Miercoles inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="mie_ini" value="{{ (Input::old('mie_ini') == null)?"":date('H:i',strtotime(Input::old('mie_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="mie_fin" value="{{ (Input::old('mie_fin') == null)?"":date('H:i',strtotime(Input::old('mie_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("jue",1,(Input::old('jue_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'jue')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_ini','Jueves inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="jue_ini" value="{{ (Input::old('jue_ini') == null)?"":date('H:i',strtotime(Input::old('jue_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_fin','Jueves fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="jue_fin" value="{{ (Input::old('jue_fin') == null)?"":date('H:i',strtotime(Input::old('jue_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("vie",1,(Input::old('vie_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'vie')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_ini','Viernes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="vie_ini" value="{{ (Input::old('vie_ini') == null)?"":date('H:i',strtotime(Input::old('vie_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_fin','Viernes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="vie_fin" value="{{ (Input::old('vie_fin') == null)?"":date('H:i',strtotime(Input::old('vie_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("sab",1,(Input::old('sab_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'sab')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_ini','Sabado inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="sab_ini" value="{{ (Input::old('sab_ini') == null)?"":date('H:i',strtotime(Input::old('sab_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                              
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_fin','Sabado fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="sab_fin" value="{{ (Input::old('sab_fin') == null)?"":date('H:i',strtotime(Input::old('sab_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-2">
                              <div class="checkbox">
                                    <label>
                                          {{ Form::checkbox("dom",1,(Input::old('dom_ini') == "00:00:00")?true:false,array('class'=>'desactivar','id'=>'dom')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_ini','Domingo inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timeini" name="dom_ini" value="{{ (Input::old('dom_ini') == null)?"":date('H:i',strtotime(Input::old('dom_ini')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_fin','Domingo fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control timefin" name="dom_fin" value="{{ (Input::old('dom_fin') == null)?"":date('H:i',strtotime(Input::old('dom_fin')))}}">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                              </div>                             
                        </div>
                  </div>      
            </div>            
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="tc" value="0" />{{ Form::checkbox("tc",true,Input::old("tc")) }} tc 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="td" value="0" />{{ Form::checkbox("td",true,Input::old("td")) }} td 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="estacionamiento" value="0" />{{ Form::checkbox("estacionamiento",true,Input::old("estacionamiento")) }} estacionamiento 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="valet" value="0" />{{ Form::checkbox("valet",true,Input::old("valet")) }} valet 
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="envio_domicilio" value="0" />{{ Form::checkbox("envio_domicilio",true,Input::old("envio_domicilio")) }} envio_domicilio 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="wifi" value="0" />{{ Form::checkbox("wifi",true,Input::old("wifi")) }} wifi 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="paqueteria" value="0" />{{ Form::checkbox("paqueteria",true,Input::old("paqueteria")) }} paqueteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="mascotas" value="0" />{{ Form::checkbox("mascotas",true,Input::old("mascotas")) }} mascotas 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="barra_libre" value="0" />{{ Form::checkbox("barra_libre",true,Input::old("barra_libre")) }} barra_libre 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="formal" value="0" />{{ Form::checkbox("formal",true,Input::old("formal")) }} formal 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="camara_perm" value="0" />{{ Form::checkbox("camara_perm",true,Input::old("camara_perm")) }} camara_perm 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="restaurante" value="0" />{{ Form::checkbox("restaurante",true,Input::old("restaurante")) }} restaurante 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="solo_mujeres" value="0" />{{ Form::checkbox("solo_mujeres",true,Input::old("solo_mujeres")) }} solo_mujeres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="solo_hombres" value="0" />{{ Form::checkbox("solo_hombres",true,Input::old("solo_hombres")) }} solo_hombres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="personalizado" value="0" />{{ Form::checkbox("personalizado",true,Input::old("personalizado")) }} personalizado 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="taller" value="0" />{{ Form::checkbox("taller",true,Input::old("taller")) }} taller 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="clases_extra" value="0" />{{ Form::checkbox("clases_extra",true,Input::old("clases_extra")) }} clases_extra 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="informacion" value="0" />{{ Form::checkbox("informacion",true,Input::old("informacion")) }} informacion 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="lavanderia" value="0" />{{ Form::checkbox("lavanderia",true,Input::old("lavanderia")) }} lavanderia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="gimnasio" value="0" />{{ Form::checkbox("gimnasio",true,Input::old("gimnasio")) }} gimnasio 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="restaurante" value="0" />{{ Form::checkbox("restaurante",true,Input::old("restaurante")) }} restaurante 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="membresia" value="0" />{{ Form::checkbox("membresia",true,Input::old("membresia")) }} membresia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cafeteria" value="0" />{{ Form::checkbox("cafeteria",true,Input::old("cafeteria")) }} cafeteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="pension" value="0" />{{ Form::checkbox("pension",true,Input::old("pension")) }} pension 
                        </label>
                  </div>                  
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cambios" value="0" />{{ Form::checkbox("cambios",true,Input::old("cambios")) }} cambios 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="devoluciones" value="0" />{{ Form::checkbox("devoluciones",true,Input::old("devoluciones")) }} devoluciones 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="bicicleta" value="0" />{{ Form::checkbox("bicicleta",true,Input::old("bicicleta")) }} bicicleta 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="alcohol" value="0" />{{ Form::checkbox("alcohol",true,Input::old("alcohol")) }} alcohol 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="familiar" value="0" />{{ Form::checkbox("familiar",true,Input::old("familiar")) }} familiar 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cita" value="0" />{{ Form::checkbox("cita",true,Input::old("cita")) }} cita 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="pagos_diferidos" value="0" />{{ Form::checkbox("pagos_diferidos",true,Input::old("pagos_diferidos")) }} pagos_diferidos 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="facturacion" value="0" />{{ Form::checkbox("facturacion",true,Input::old("facturacion")) }} facturacion 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="mensajeria" value="0" />{{ Form::checkbox("mensajeria",true,Input::old("mensajeria")) }} mensajeria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="internacional" value="0" />{{ Form::checkbox("internacional",true,Input::old("internacional")) }} internacional 
                        </label>
                  </div>
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Agregar imagen de negocio 250px * 250px') }}
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
@include('layouts.show_form_errors')
<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear negocio</button>      
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}


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

<script>
      function save_map(event) {
            $('#latlng').val(event.latLng);
            createMarker_map({map: map, position: event.latLng});
      }
</script>

<script>
      $('.clockpicker').clockpicker();
</script>

<script>
      $('#ini').focusout(function () {
            valor = $('#ini').val();

            $(".timeini").val(valor);
      });
      $('#fin').focusout(function () {
            valor = $('#fin').val();

            $(".timefin").val(valor);
      });

      $(".desactivar").click(function (e) {
            var dia = $(this).attr('id');
            if ($(this).prop('checked')) {
                  $("input[name=" + dia + "_ini]").prop('disabled', true);
                  $("input[name=" + dia + "_ini]").val('');
                  $("input[name=" + dia + "_fin]").prop('disabled', true);
                  $("input[name=" + dia + "_fin]").val('');
            } else {
                  $("input[name=" + dia + "_ini]").prop('disabled', false);
                  $("input[name=" + dia + "_fin]").prop('disabled', false);
            }

      });
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
      var map;
      var markers = [];
      
      
      function initialize() {

            var mapOptions = {
                  center: {lat: 19.43938462939674, lng: -99.13208094891161},
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
            
            if(markers.length){
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
            geocoder.geocode( { 'address': address}, function(results, status) {
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