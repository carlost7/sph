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

            <div class="text-right">
                  @if($pago->pagado)
                  <p>Pagado: {{ ($pago->pagado) ? 'Si' : 'No' }} - Método:{{$pago->metodo}}</p>
                  @else
                  <div class="show">
                        {{ HTML::linkRoute('client_avisar','Activación Manual',null,array('class'=>'btn btn-sm btn-info')) }}
                        <a href='#' class='btn btn-sm btn-success' onclick='show_buttons({{$pago->id}})'>Activación Automática</a>
                  </div>
                  <br/>
                  <div id="{{ $pago->id }}" class="hidden">
                        {{ HTML::linkRoute('clientes_pagos_codigo.get','Usar código',$pago->id,array('class'=>'btn btn-sm btn-success')) }}                   
                        {{ HTML::linkRoute('clientes_pagos.edit','Mercado Pago',$pago->id,array('class'=>'btn btn-sm btn-success')) }}                  

                  </div>
                  @endif
            </div>
      </div>
      @endforeach
</div>




@else

<h3>No hay pagos</h3>

@endif


@stop

@section('scripts')

<script type="text/javascript">
              function show_buttons(id) {
                  var buttons = $("#" + id);
                  if(buttons.hasClass('hidden')){
                        buttons.removeClass('hidden');
                        buttons.addClass('show');
                  }else{
                        buttons.removeClass('show');
                        buttons.addClass('hidden');
                  }
                  
              }
</script>

@stop
