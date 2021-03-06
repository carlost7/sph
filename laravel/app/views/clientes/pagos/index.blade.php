@extends('layouts.client_dashboard_master')

@section('content')

<h2>Lista de Pagos</h2>

@if($pagos->count())

{{ $pagos->links() }}

<div class="list-group">
      @if($necesita_pagar)
      {{ HTML::linkRoute('pagar_contenido.get','Activar todo',null,array('class'=>'btn btn-sm btn-warning')) }}
      <br>
      <br>
      @endif

      @foreach($pagos as $pago)

      <div class="list-group-item {{ $pago->pagado || $pago->pagable->publicar ? 'published' : 'not-published' }}">
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
                  @if(is_a($pago->pagable, Promocion::class) || is_a($pago->pagable, Evento::class))
                  Fechas de publicación: {{ date('d-m-Y',strtotime($pago->pagable->publicacion_inicio)).' - '.date('d-m-Y',strtotime($pago->pagable->publicacion_fin)) }}
                  @else
                  Pago generado: {{ date('d-m-Y',strtotime($pago->updated_at)) }}
                  @endif
            </p>       
            <p>
                  {{ $pago->status }}
            </p>

            <div class="text-right">
                  @if($pago->pagado)
                  <p>Pagado: {{ ($pago->pagado) ? 'Si' : 'No' }} - Método: {{$pago->metodo}}</p>
                  @else
                  <div class="show">
                        @if($pago->pagable->aviso || $pago->pagable->publicar )

                        {{ Form::button('Activación Manual',array('class'=>'btn btn-sm btn-info disabled')) }}

                        @else

                        @if(!is_a($pago->pagable, Promocion::class))

                        {{ HTML::linkRoute('clientes_pagos_avisar_marketing.get','Activación Manual',$pago->id,array('class'=>'btn btn-sm btn-info')) }}

                        @endif
                        
                        @endif

                        {{ HTML::linkRoute('clientes_pagos_codigo.get','Usar código',$pago->id,array('class'=>'btn btn-sm btn-success')) }}

                        {{ HTML::linkRoute('pagar_contenido.get','Activación automática',array('id'=>$pago->id),array('class'=>'btn btn-sm btn-success')) }}
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


