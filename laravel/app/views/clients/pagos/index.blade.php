@extends('layouts.client_dashboard_master')

@section('content')

<h2>Lista de Pagos</h2>

@if($pagos->count())

{{ $pagos->links() }}

<div class="list-group">
      @foreach($pagos as $pago)

      <div class="list-group-item {{ $pago->pagado ? 'published' : 'not-published' }}">
            <h3 class="text-left">                  
                  {{ $pago->descripcion }}
            </h3>
            <h4>
                  {{$pago->nombre}}
            </h4>
            <p>
                  ${{ $pago->monto }}
            </p>
            <p>
                  {{ $pago->created_at }}
            </p>
            
            <p class="text-right">
                  @if($pago->pagado)
                  Pagado: {{ ($pago->pagado) ? 'Si' : 'No' }} - Método:{{$pago->metodo}}
                  @else
                  {{ HTML::linkRoute('clientes_pagos_codigo.get','Usar código',$pago->id,array('class'=>'btn btn-sm btn-info')) }}                   
                  {{ HTML::linkRoute('clientes_pagos.edit','Pagar Paypal',$pago->id,array('class'=>'btn btn-sm btn-info')) }}                  
                  @endif
            </p>
      </div>
      @endforeach
</div>




@else

<h3>No hay pagos</h3>

@endif


@stop