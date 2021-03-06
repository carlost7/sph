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
      <p class="list-group-item"><span class="label label-default">Estado:</span> {{ $negocio->estado->estado }}</p>
      @if(count($negocio->zona))
      <p class="list-group-item"><span class="label label-default">Zona:</span> {{ $negocio->zona->zona }}</p>
      @endif
      <p class="list-group-item"><span class="label label-default">Categoria:</span> {{ $negocio->categoria->categoria }}</p>
      @if(count($negocio->subcategoria))
      <p class="list-group-item"><span class="label label-default">Subcategoria:</span>    {{ $negocio->subcategoria->subcategoria }}</p>      
      @endif
</div>

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
@if(count($negocio->masInfo))
                  <div class="list-group">  
                        @if ($negocio->masInfo->tc)  
                        <span><p class="list-group-item"><span class="label label-default">tc</span>Si</p></span>
                        @endif                        
                        @if ($negocio->masInfo->td)  
                        <span><p class="list-group-item"><span class="label label-default">td</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->estacionamiento)  
                        <span><p class="list-group-item"><span class="label label-default">estacionamiento</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->valet)  
                        <span><p class="list-group-item"><span class="label label-default">valet</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->envio_domicilio)  
                        <span><p class="list-group-item"><span class="label label-default">envio_domicilio</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->wifi)  
                        <span><p class="list-group-item"><span class="label label-default">wifi</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->paqueteria)  
                        <span><p class="list-group-item"><span class="label label-default">paqueteria</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->mascotas)  
                        <span><p class="list-group-item"><span class="label label-default">mascotas</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->barra_libre)  
                        <span><p class="list-group-item"><span class="label label-default">barra_libre</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->formal)  
                        <span><p class="list-group-item"><span class="label label-default">formal</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->camara_perm)  
                        <span><p class="list-group-item"><span class="label label-default">camara_perm</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->restaurante)  
                        <span><p class="list-group-item"><span class="label label-default">restaurante</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->solo_mujeres)  
                        <span><p class="list-group-item"><span class="label label-default">solo_mujeres</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->solo_hombres)  
                        <span><p class="list-group-item"><span class="label label-default">solo_hombres</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->personalizado)  
                        <span><p class="list-group-item"><span class="label label-default">personalizado</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->taller)  
                        <span><p class="list-group-item"><span class="label label-default">taller</span>Si</p></span>
                        @endif
                        
                        @if ($negocio->masInfo->clases_extra)  
                        <span><p class="list-group-item"><span class="label label-default">clases_extra</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->informacion)  
                        <span><p class="list-group-item"><span class="label label-default">informacion</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->lavanderia)  
                        <span><p class="list-group-item"><span class="label label-default">lavanderia</span>Si</p></span>
                        @endif
                        
                        @if ($negocio->masInfo->gimnasio)  
                        <span><p class="list-group-item"><span class="label label-default">gimnasio</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->restaurante)  
                        <span><p class="list-group-item"><span class="label label-default">restaurante</span>Si</p></span>
			@endif

                        @if ($negocio->masInfo->membresia)  
                        <span><p class="list-group-item"><span class="label label-default">membresia</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->cafeteria)  
                        <span><p class="list-group-item"><span class="label label-default">cafeteria</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->pension)  
                        <span><p class="list-group-item"><span class="label label-default">pension</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->cambios)  
                        <span><p class="list-group-item"><span class="label label-default">cambios</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->devoluciones)  
                        <span><p class="list-group-item"><span class="label label-default">devoluciones</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->bicicleta)  
                        <span><p class="list-group-item"><span class="label label-default">bicicleta</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->alcohol)  
                        <span><p class="list-group-item"><span class="label label-default">alcohol</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->familiar)  
                        <span><p class="list-group-item"><span class="label label-default">familiar</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->cita)  
                        <span><p class="list-group-item"><span class="label label-default">cita</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->pagos_diferidos)  
                        <span><p class="list-group-item"><span class="label label-default">pagos_diferidos</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->facturacion)  
                        <span><p class="list-group-item"><span class="label label-default">facturacion</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->mensajeria)  
                        <span><p class="list-group-item"><span class="label label-default">mensajeria</span>Si</p></span>
                        @endif

                        @if ($negocio->masInfo->internacional)  
                        <span><p class="list-group-item"><span class="label label-default">internacional</span>Si</p></span>
                        @endif
                        

                  </div>
                  @endif
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