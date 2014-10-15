@extends('layouts.client_dashboard_master')

@section('content')
@if($negocio)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_negocios.edit','Editar negocio',$negocio->id) }}</li>            
            <li>{{ HTML::linkRoute('clientes_comentarios.index','Mostrar comentarios',array('id'=>$negocio->id,'clase'=>get_class($negocio))) }}</li>            
      </ul>
</div>


<h2>{{ $negocio->nombre }}</h2>
@if(count($negocio->imagen))
<img src="{{ Config::get('params.path_serve_image_transform').Image::path($negocio->imagen->path.$negocio->imagen->nombre,'resizeCrop',250,250,'left','top') }}" alt="{{ $negocio->imagen->alt }}" />
@endif
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Teléfono:</span> {{ $negocio->telefono }}</p>
      <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $negocio->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $negocio->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
</div>

@if(count($negocio->masInfo))
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Acepta Efectivo:</span>{{ ($negocio->masInfo->efectivo)  ? "Si" : "No" }}</p>
      <p class="list-group-item"><span class="label label-default">Acepta Tarjeta de Credito:</span>{{ ($negocio->masInfo->tc) ? "Si" : "No" }}</p>
      <p class="list-group-item"><span class="label label-default">Acepta Tarjeta de Debito:</span>{{ ($negocio->masInfo->td)  ? "Si" : "No" }}</p>
      <p class="list-group-item"><span class="label label-default">Es Ambiente Familiar:</span>{{ ($negocio->masInfo->familiar)  ? "Si" : "No"}}</p>
      <p class="list-group-item"><span class="label label-default">Cuenta con Estacionamiento:</span>{{ ($negocio->masInfo->estacionamiento)  ? "Si" : "No"}}</p>
      <p class="list-group-item"><span class="label label-default">Cuenta con Valet Parking:</span>{{ ($negocio->masInfo->valet_parking) ? "Si" : "No" }}</p>
      <p class="list-group-item"><span class="label label-default">Cuenta con Wi-FiI:</span>{{ ($negocio->masInfo->wifi) ? "Si" : "No" }}</p>
      <p class="list-group-item"><span class="label label-default">Se Permiten Mascotas:</span>{{ ($negocio->masInfo->mascotas) ? "Si" : "No" }}</p>      
</div>
@endif

@if(count($negocio->horario))
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Lunes:</span>    {{ date('H:i',strtotime($negocio->horario->lun_ini)).' - '.date('H:i',strtotime($negocio->horario->lun_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Martes:</span>   {{ date('H:i',strtotime($negocio->horario->mar_ini)).' - '.date('H:i',strtotime($negocio->horario->mar_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Miércoles:</span>{{ date('H:i',strtotime($negocio->horario->mie_ini)).' - '.date('H:i',strtotime($negocio->horario->mie_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Jueves:</span>   {{ date('H:i',strtotime($negocio->horario->jue_ini)).' - '.date('H:i',strtotime($negocio->horario->jue_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Viernes:</span>  {{ date('H:i',strtotime($negocio->horario->vie_ini)).' - '.date('H:i',strtotime($negocio->horario->vie_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Sábado:</span>   {{ date('H:i',strtotime($negocio->horario->sab_ini)).' - '.date('H:i',strtotime($negocio->horario->sab_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Domingo:</span>  {{ date('H:i',strtotime($negocio->horario->dom_ini)).' - '.date('H:i',strtotime($negocio->horario->dom_fin)) }}</p>
</div>
@endif

@if(count($negocio->especial))
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $negocio->especial->webpage }}</p>
      <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $negocio->especial->email }}</p>
      <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $negocio->likes }}</p>
      <p class="list-group-item"><span class="label label-default">Mapa:</span>   
            @if($mapa)            
            {{ $mapa['html'] }}                  
            @endif
      </p>
</div>

@foreach($negocio->especial->imagenes as $imagen)
<img src="{{Config::get('params.path_serve_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" />
@endforeach

@endif

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop

@section('scripts')
@if($mapa)
{{ $mapa['js'] }}
@endif
@stop