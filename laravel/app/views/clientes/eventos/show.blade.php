@extends('layouts.client_dashboard_master')

@section('content')
@if($evento)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_eventos.edit','Editar evento',$evento->id) }}</li>            
            <li>{{ HTML::linkRoute('clientes_comentarios.index','Mostrar comentarios',array('id'=>$evento->id,'clase'=>get_class($evento))) }}</li>            
      </ul>
</div>


<h2>{{ $evento->nombre }}</h2>

@if(count($evento->imagen))
<img src="{{Config::get('params.path_serve_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" />
@endif

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Fecha:</span> {{ date('d-m-Y',strtotime($evento->fecha_inicio)).' - '.date('d-m-Y',strtotime($evento->fecha_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Horario:</span> {{ date('H:i',strtotime($evento->hora_inicio)).' - '.date('H:i',strtotime($evento->hora_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Lugar:</span> {{ $evento->lugar }}</p>
      <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $evento->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $evento->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Telefono:</span> {{ $evento->telefono }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}</p>
</div>

@if(count($evento->masInfo))

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Moneda:</span> {{ $evento->moneda }}</p>
      <p class="list-group-item"><span class="label label-default">Costo:</span> {{ $evento->costo }}</p>
      <p class="list-group-item"><span class="label label-default">Edad mínima:</span> {{ $evento->min_edad }}</p>
      <p class="list-group-item"><span class="label label-default">Edad máxima:</span> {{ $evento->max_edad }}</p>
      <p class="list-group-item"><span class="label label-default">Cuenta con alcohol:</span> {{ ($evento->masInfo->alcohol) ? 'Si' : 'No' }}</p>
      <p class="list-group-item"><span class="label label-default">Acepta tarjeta de credito:</span> {{ ($evento->masInfo->tc) ? 'Si' : 'No' }}</p>
      <p class="list-group-item"><span class="label label-default">Acepta tarjeta de debito:</span> {{ ($evento->masInfo->td) ? 'Si' : 'No' }}</p>
      <p class="list-group-item"><span class="label label-default">Acepta efectivo:</span> {{ ($evento->masInfo->efectivo) ? 'Si' : 'No' }}</p>
      <p class="list-group-item"><span class="label label-default">Otra:</span> {{ $evento->masInfo->otra }}</p>
</div>

@endif

@if(count($evento->especial))
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $evento->especial->web }}</p>
      <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $evento->especial->email }}</p>
      <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $evento->likes }}</p>
      <p class="list-group-item"><span class="label label-default">Mapa:</span>   
            @if($mapa)            
            {{ $mapa['html'] }}                  
            @endif
      </p>
</div>
@foreach($evento->especial->imagenes as $imagen)
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