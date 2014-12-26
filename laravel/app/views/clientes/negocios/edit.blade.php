@extends('layouts.client_dashboard_master')

@section('content')

@if($negocio)
<h2>Editar: {{ $negocio->nombre }}</h2>

{{ Form::model($negocio, array('route' => array('publicar.clientes_negocios.update', $negocio->id), 'method' => 'PUT','files'=>true)) }}

<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado_id','Estado') }}
                  {{ Form::select('estado_id', $estados->lists('estado','id'),$negocio->estado->id,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona_id','Zona') }}
                  {{ Form::select('zona_id', array(),(count($negocio->zona))?$negocio->zona->id:null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria_id','Categoria') }}
                  {{ Form::select('categoria_id', $categorias->lists('categoria','id'),$negocio->categoria->id,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria_id','subcategoria') }}
                  {{ Form::select('subcategoria_id', array(),(count($negocio->subcategoria))?$negocio->subcategoria->id:null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>
</div>
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', $negocio->direccion, array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', $negocio->telefono, array('placeholder' => 'telefono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', $negocio->descripcion, array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('webpage', 'Página web') }}            
      {{ Form::text('webpage', ($negocio->webpage) ? $negocio->webpage : '' ,array('placeholder'=>'página web','class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('email', 'Correo electrónico') }}            
      {{ Form::text('email', ($negocio->email) ? $negocio->email : '' ,array('placeholder'=>'correo electrónico','class'=>'form-control')) }}
</div>        
@if(count($negocio->masInfo))
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="tc" value="0" />{{ Form::checkbox("tc",true,$negocio->masInfo->tc) }} tc 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="td" value="0" />{{ Form::checkbox("td",true,$negocio->masInfo->td) }} td 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="estacionamiento" value="0" />{{ Form::checkbox("estacionamiento",true,$negocio->masInfo->estacionamiento) }} estacionamiento 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="valet" value="0" />{{ Form::checkbox("valet",true,$negocio->masInfo->valet) }} valet 
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="envio_domicilio" value="0" />{{ Form::checkbox("envio_domicilio",true,$negocio->masInfo->envio_domicilio) }} envio_domicilio 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="wifi" value="0" />{{ Form::checkbox("wifi",true,$negocio->masInfo->wifi) }} wifi 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="paqueteria" value="0" />{{ Form::checkbox("paqueteria",true,$negocio->masInfo->paqueteria) }} paqueteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="mascotas" value="0" />{{ Form::checkbox("mascotas",true,$negocio->masInfo->mascotas) }} mascotas 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="barra_libre" value="0" />{{ Form::checkbox("barra_libre",true,$negocio->masInfo->barra_libre) }} barra_libre 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="formal" value="0" />{{ Form::checkbox("formal",true,$negocio->masInfo->formal) }} formal 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="camara_perm" value="0" />{{ Form::checkbox("camara_perm",true,$negocio->masInfo->camara_perm) }} camara_perm 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="restaurante" value="0" />{{ Form::checkbox("restaurante",true,$negocio->masInfo->restaurante) }} restaurante 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="solo_mujeres" value="0" />{{ Form::checkbox("solo_mujeres",true,$negocio->masInfo->solo_mujeres) }} solo_mujeres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="solo_hombres" value="0" />{{ Form::checkbox("solo_hombres",true,$negocio->masInfo->solo_hombres) }} solo_hombres 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="personalizado" value="0" />{{ Form::checkbox("personalizado",true,$negocio->masInfo->personalizado) }} personalizado 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="taller" value="0" />{{ Form::checkbox("taller",true,$negocio->masInfo->taller) }} taller 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="clases_extra" value="0" />{{ Form::checkbox("clases_extra",true,$negocio->masInfo->clases_extra) }} clases_extra 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="informacion" value="0" />{{ Form::checkbox("informacion",true,$negocio->masInfo->informacion) }} informacion 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="lavanderia" value="0" />{{ Form::checkbox("lavanderia",true,$negocio->masInfo->lavanderia) }} lavanderia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="gimnasio" value="0" />{{ Form::checkbox("gimnasio",true,$negocio->masInfo->gimnasio) }} gimnasio 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="restaurante" value="0" />{{ Form::checkbox("restaurante",true,$negocio->masInfo->restaurante) }} restaurante 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="membresia" value="0" />{{ Form::checkbox("membresia",true,$negocio->masInfo->membresia) }} membresia 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cafeteria" value="0" />{{ Form::checkbox("cafeteria",true,$negocio->masInfo->cafeteria) }} cafeteria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="pension" value="0" />{{ Form::checkbox("pension",true,$negocio->masInfo->pension) }} pension 
                        </label>
                  </div>                  
            </div>
      </div>
      <div class="row">

            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cambios" value="0" />{{ Form::checkbox("cambios",true,$negocio->masInfo->cambios) }} cambios 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="devoluciones" value="0" />{{ Form::checkbox("devoluciones",true,$negocio->masInfo->devoluciones) }} devoluciones 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="bicicleta" value="0" />{{ Form::checkbox("bicicleta",true,$negocio->masInfo->bicicleta) }} bicicleta 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="alcohol" value="0" />{{ Form::checkbox("alcohol",true,$negocio->masInfo->alcohol) }} alcohol 
                        </label>
                  </div>                  
            </div>
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="familiar" value="0" />{{ Form::checkbox("familiar",true,$negocio->masInfo->familiar) }} familiar 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="cita" value="0" />{{ Form::checkbox("cita",true,$negocio->masInfo->cita) }} cita 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="pagos_diferidos" value="0" />{{ Form::checkbox("pagos_diferidos",true,$negocio->masInfo->pagos_diferidos) }} pagos_diferidos 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="facturacion" value="0" />{{ Form::checkbox("facturacion",true,$negocio->masInfo->facturacion) }} facturacion 
                        </label>
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">

                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="mensajeria" value="0" />{{ Form::checkbox("mensajeria",true,$negocio->masInfo->mensajeria) }} mensajeria 
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              <input type="hidden" name="internacional" value="0" />{{ Form::checkbox("internacional",true,$negocio->masInfo->internacional) }} internacional 
                        </label>
                  </div>
            </div>
      </div>
</div>
@endif

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
                                          {{ Form::checkbox("lun",1,($negocio->horario->lun_ini == null )?true:false,array('class'=>'desactivar','id'=>'lun')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_ini','Lunes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="lun_ini" value="{{$negocio->horario->lun_ini}}">
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('lun_fin','Lunes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="lun_fin" value="{{ $negocio->horario->lun_fin}}">
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
                                          {{ Form::checkbox("mar",1,($negocio->horario->mar_ini == null)?true:false,array('class'=>'desactivar','id'=>'mar')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_ini','Martes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="mar_ini" value="{{ $negocio->horario->mar_ini}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mar_fin','Martes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mar_fin" value="{{ $negocio->horario->mar_fin}}">
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
                                          {{ Form::checkbox("mie",1,(($negocio->horario->mie_ini == null))?true:false,array('class'=>'desactivar','id'=>'mie')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_ini','Miercoles inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="mie_ini" value="{{ $negocio->horario->mie_ini}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('mie_fin','Miercoles fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="mie_fin" value="{{ $negocio->horario->mie_fin}}">
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
                                          {{ Form::checkbox("jue",1,($negocio->horario->jue_ini == null)?true:false,array('class'=>'desactivar','id'=>'jue')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_ini','Jueves inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="jue_ini" value="{{ $negocio->horario->jue_ini}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('jue_fin','Jueves fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="jue_fin" value="{{ $negocio->horario->jue_fin}}">
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
                                          {{ Form::checkbox("vie",1,($negocio->horario->vie_ini == null)?true:false,array('class'=>'desactivar','id'=>'vie')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_ini','Viernes inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="vie_ini" value="{{ $negocio->horario->vie_ini}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('vie_fin','Viernes fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="vie_fin" value="{{ $negocio->horario->vie_fin}}">
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
                                          {{ Form::checkbox("sab",1,($negocio->horario->sab_ini == null)?true:false,array('class'=>'desactivar','id'=>'sab')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_ini','Sabado inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="sab_ini" value="{{ $negocio->horario->sab_ini}}">
                              </div>                              
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('sab_fin','Sabado fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="sab_fin" value="{{ $negocio->horario->sab_fin}}">
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
                                          {{ Form::checkbox("dom",1,($negocio->horario->dom_ini == null)?true:false,array('class'=>'desactivar','id'=>'dom')) }}
                                          Cerrado
                                    </label>
                              </div>
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_ini','Domingo inicio') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                    <input type="text" class="form-control" name="dom_ini" value="{{ $negocio->horario->dom_ini}}">
                              </div>                             
                        </div>
                        <div class="col-sm-5">
                              {{ Form::label('dom_fin','Domingo fin') }}
                              <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="text" class="form-control" name="dom_fin" value="{{ $negocio->horario->dom_fin}}">
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
            <div class="col-sm-12">
                  {{ Form::label('imagen','Editar imagen de negocio 250px * 250px') }}
                  {{ Form::file('imagen') }}
            </div>
      </div>
</div>
<div class="form-group">
      {{ Form::hidden('lat',$negocio->lat,array('id'=>'map-lat')) }}
      {{ Form::hidden('long',$negocio->long,array('id'=>'map-lng')) }}
      <button type="button" class=" btn btn-primary" onclick="searchPlace()">Usar campo dirección</button><div class="address_error" id="address_error"></div>
      <div id="map-canvas"></div>      
      <div id="transparente"></div>      
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Editar negocio</button>
</div>        



{{ Form::close() }}


@else
<h2>No seleccionó ningún evento para editar</h2>

@endif


@stop

@section('scripts')
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/bootstrap-clockpicker.min.js') }}

<script>
      $(document).ready(function() {
            $('#estados').change(function() {
            var estado_id = $("#estados").val();
            url = base_url + "/obtener_zona/" + estado_id;
                  $.get(url).done(function(data) {
                        $("#zonas").empty();
                        for (i = 0; i < data.length; i++) {
                              resultado = data[i];
                              if (resultado.id == {{(count($negocio->zona))?$negocio->zona->id:''}}){
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.zona + "</option>";
                              } else {
                                    elemento = "<option value=" + resultado.id + ">" + resultado.zona + "</option>";
                              }
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
                              if (resultado.id == {{(count($negocio->subcategoria))?$negocio->subcategoria->id:''}}){
                                    elemento = "<option value=" + resultado.id + " selected >" + resultado.subcategoria + "</option>";
                              } else {
                                    elemento = "<option value=" + resultado.id + ">" + resultado.subcategoria + "</option>";
                              }
                              $("#subcats").append(elemento);
                        }
                  });
            }).trigger('change');
      });
</script>

<script>
      $('.clockpicker').clockpicker();
      
      $(".desactivar").click(function(e) {
            var dia = $(this).attr('id');
            if ($(this).prop('checked')) {
                  $("input[name=" + dia + "_ini]").prop('disabled', true);
                  $("input[name=" + dia + "_ini]").val('');
                  $("input[name=" + dia + "_fin]").prop('disabled', true);
                  $("input[name=" + dia + "_fin]").val('');
            } else{
                  $("input[name=" + dia + "_ini]").prop('disabled', false);
                  $("input[name=" + dia + "_fin]").prop('disabled', false);
            }
      });
      
      $(document).ready(function(){
            $(".desactivar").each(function(i){
                  var dia = $(this).attr('id');
                  if ($(this).prop('checked')) {
                        $("input[name=" + dia + "_ini]").prop('disabled', true);
                        $("input[name=" + dia + "_fin]").prop('disabled', true);
                  } else {
                        $("input[name=" + dia + "_ini]").prop('disabled', false);
                        $("input[name=" + dia + "_fin]").prop('disabled', false);
                  }
            });
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
if (!isset($negocio->lat) || !isset($negocio->long))
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
            var lat = {{$negocio->lat}};
            var lng = {{$negocio->long}};
            pos = new google.maps.LatLng(lat, lng);
            map.setCenter(pos);
            var marker = new google.maps.Marker({
                  position: pos,
                  map: map
            });
            markers.push(marker);
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