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
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $evento->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Direccion:</span> {{ $evento->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Inicio:</span> {{ $evento->inicio }}</p>
      <p class="list-group-item"><span class="label label-default">Fin:</span> {{ $evento->fin }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($evento->publicar) ? "Si" : "No" }}</p>
</div>

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop