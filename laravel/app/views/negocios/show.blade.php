@extends('layouts.client_dashboard_master')

@section('content')
@if($negocio)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_negocios.edit','Editar negocio',$negocio->id) }}</li>            
      </ul>
</div>


<h2>{{ $negocio->nombre }}</h2>

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $negocio->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Teléfono:</span> {{ $negocio->telefono }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $negocio->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
</div>

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop