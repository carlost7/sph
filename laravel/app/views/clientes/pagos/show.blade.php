@extends('layouts.client_dashboard_master')

@section('content')
@if($pago)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_pagos.edit','Editar evento',$pago->id) }}</li>            
      </ul>
</div>


<h2>{{ $pago->nombre }}</h2>

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $pago->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Direccion:</span> {{ $pago->direccion }}</p>
      <p class="list-group-item"><span class="label label-default">Inicio:</span> {{ $pago->inicio }}</p>
      <p class="list-group-item"><span class="label label-default">Fin:</span> {{ $pago->fin }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($pago->publicar) ? "Si" : "No" }}</p>
</div>

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop