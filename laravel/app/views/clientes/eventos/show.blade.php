@extends('layouts.client_dashboard_master')

@section('content')
@if($evento)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_eventos.edit','Editar evento',$evento->id) }}</li>            
      </ul>
</div>


<h2>{{ $evento->nombre }}</h2>

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Fecha:</span> {{ $evento->fecha_inicio.' - '$evento->fecha_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Horario:</span> {{ $evento->hora_inicio.' - '$evento->hora_fin }}</p>
      <p class="list-group-item"><span class="label label-default">Lugar:</span> {{ $evento->lugar }}</p>
      <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $evento->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $evento->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Telefono:</span> {{ $evento->telefono }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}</p>
</div>

@if($evento->masInfo->count())

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

@if($evento->is_especial)

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $evento->especial->web }}</p>
      <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $evento->especial->email }}</p>
      <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $evento->likes }}
            @if($mapa)            
            {{ $mapa['html'] }}                  
            @endif
      </p>
      <p class="list-group-item"><span class="label label-default">Mapa:</span>   {{ $evento->especial->mapa }}</p>
</div>

@endif

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop