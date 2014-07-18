@extends('layouts.client_dashboard_master')

@section('content')
@if($promocion)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_promociones.edit','Editar promoción',$promocion->id) }}</li>            
      </ul>
</div>


<h2>{{ $promocion->nombre }}</h2>

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $promocion->descripcion }}</p>      
      <p class="list-group-item"><span class="label label-default">Inicio:</span> {{ $promocion->inicio }}</p>
      <p class="list-group-item"><span class="label label-default">Fin:</span> {{ $promocion->fin }}</p>
      <p class="list-group-item"><span class="label label-default">Imágen:</span> {{ $promocion->path }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($promocion->publicar) ? "Si" : "No" }}</p>
</div>

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop