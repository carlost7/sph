@extends('layouts.client_dashboard_master')

@section('content')
@if($negocio)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('publicar.clientes_negocios.edit','Editar negocio',$negocio->id) }}</li>            
            <li>{{ HTML::linkRoute('clientes_comentarios.index','Mostrar comentarios',array('id'=>$negocio->id,'clase'=>get_class($negocio))) }}</li>            
      </ul>
</div>


<h2>{{ $negocio->nombre }}</h2>
@if($negocio->imagen_file_name != "")
<img src="{{ URL::to("/").$negocio->imagen->url('medium')}}">
@endif
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Teléfono:</span> {{ $negocio->telefono }}</p>
      <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $negocio->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $negocio->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $negocio->webpage }}</p>
      <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $negocio->email }}</p>
      <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $negocio->likes }}</p>      
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
</div>

@if(count($negocio->masInfo))
<div class="list-group">  
      <span><p class="list-group-item"><span class="label label-default">tc</span>{{ ($negocio->masInfo->tc)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">td</span>{{ ($negocio->masInfo->td)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">estacionamiento</span>{{ ($negocio->masInfo->estacionamiento)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">valet</span>{{ ($negocio->masInfo->valet)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">envio_domicilio</span>{{ ($negocio->masInfo->envio_domicilio)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">wifi</span>{{ ($negocio->masInfo->wifi)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">paqueteria</span>{{ ($negocio->masInfo->paqueteria)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">mascotas</span>{{ ($negocio->masInfo->mascotas)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">barra_libre</span>{{ ($negocio->masInfo->barra_libre)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">formal</span>{{ ($negocio->masInfo->formal)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">camara_perm</span>{{ ($negocio->masInfo->camara_perm)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">restaurante</span>{{ ($negocio->masInfo->restaurante)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">solo_mujeres</span>{{ ($negocio->masInfo->solo_mujeres)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">solo_hombres</span>{{ ($negocio->masInfo->solo_hombres)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">personalizado</span>{{ ($negocio->masInfo->personalizado)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">taller</span>{{ ($negocio->masInfo->taller)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">clases_extra</span>{{ ($negocio->masInfo->clases_extra)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">informacion</span>{{ ($negocio->masInfo->informacion)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">lavanderia</span>{{ ($negocio->masInfo->lavanderia)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">gimnasio</span>{{ ($negocio->masInfo->gimnasio)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">restaurante</span>{{ ($negocio->masInfo->restaurante)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">membresia</span>{{ ($negocio->masInfo->membresia)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">cafeteria</span>{{ ($negocio->masInfo->cafeteria)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">pension</span>{{ ($negocio->masInfo->pension)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">cambios</span>{{ ($negocio->masInfo->cambios)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">devoluciones</span>{{ ($negocio->masInfo->devoluciones)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">bicicleta</span>{{ ($negocio->masInfo->bicicleta)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">alcohol</span>{{ ($negocio->masInfo->alcohol)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">familiar</span>{{ ($negocio->masInfo->familiar)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">cita</span>{{ ($negocio->masInfo->cita)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">pagos_diferidos</span>{{ ($negocio->masInfo->pagos_diferidos)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">facturacion</span>{{ ($negocio->masInfo->facturacion)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">mensajeria</span>{{ ($negocio->masInfo->mensajeria)  ? "Si" : "No" }}</p></span>
      <span><p class="list-group-item"><span class="label label-default">internacional</span>{{ ($negocio->masInfo->internacional)  ? "Si" : "No" }}</p></span>
</div>
@endif

@if(count($negocio->horario))
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Lunes:</span>    {{ $negocio->horario->lun_ini.' - '.$negocio->horario->lun_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Martes:</span>   {{ $negocio->horario->mar_ini.' - '.$negocio->horario->mar_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Miércoles:</span>{{ $negocio->horario->mie_ini.' - '.$negocio->horario->mie_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Jueves:</span>   {{ $negocio->horario->jue_ini.' - '.$negocio->horario->jue_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Viernes:</span>  {{ $negocio->horario->vie_ini.' - '.$negocio->horario->vie_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Sábado:</span>   {{ $negocio->horario->sab_ini.' - '.$negocio->horario->sab_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Domingo:</span>  {{ $negocio->horario->dom_ini.' - '.$negocio->horario->dom_fin }}</p>
</div>
@endif
@if(isset($negocio->lat) && isset($negocio->long))      
<div class="form-group">
      <div id="map-canvas"></div>      
      <div id="transparente"></div>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
      <script type="text/javascript">
  var map;
  var markers = [];
  var lat = {{ $negocio->lat }};
  var long = {{ $negocio->long }};
  function initialize() {

      var mapOptions = {
            center: {lat: lat, lng: long},
            zoom: 16
      };
      
      pos = new google.maps.LatLng(lat, long);
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      var marker = new google.maps.Marker({
            position: pos,
            map: map
      });
  }

google.maps.event.addDomListener(window, 'load', initialize);


      </script>            
</div>
@endif
<div class="form-group">
      <div class="row">
            @foreach($negocio->imagenes as $imagen)
            <div class="col-sm-3">
                  <img src="{{ URL::to("/").$imagen->imagen->url('medium')}}">
            </div>      
            @endforeach
      </div>
</div>


@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop

@section('scripts')

@stop