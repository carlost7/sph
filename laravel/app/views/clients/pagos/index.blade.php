@extends('layouts.client_dashboard_master')

@section('content')

<h2>Lista de Pagos</h2>

@if($pagos->count())

<ul class="list-group">
      @foreach($pagos as $pago)

      <li class="list-group-item">
            <h3 class="text-left">                  
                  {{ HTML::linkRoute("clientes_pagos.show",$pago->nombre,$pago->id) }}                  
            </h3>
            <h3>{{ $pago->descripcion }}</h3>
            <p>
                  ${{ $pago->monto }}
            </p>
      </li>
      @endforeach
</ul>

@else

<h3>No hay pagos</h3>

@endif


@stop