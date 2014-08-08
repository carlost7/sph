@extends('layouts.client_dashboard_master')

@section('content')

<h2>Lista de Pagos</h2>

@if($pagos->count())

{{ $pagos->links() }}

<div class="list-group">
      {{ HTML::linkRoute('clientes_pagos_pagar_todo.get','Activar todo',null,array('class'=>'btn btn-sm btn-warning')) }}
      <br>
      <br>
      
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
                  {{ $pago->created_at }}
            </p>

            <div class="text-right">
                  @if($pago->pagado)
                  <p>Pagado: {{ ($pago->pagado) ? 'Si' : 'No' }} - Método:{{$pago->metodo}}</p>
                  @else
                  <div class="show">
                        @if($pago->pagable->aviso || $pago->pagable->publicar )
                        {{ Form::button('Activación Manual',array('class'=>'btn btn-sm btn-info disabled')) }}
                        @else
                        {{ HTML::linkRoute('clientes_pagos_avisar_marketing.get','Activación Manual',$pago->id,array('class'=>'btn btn-sm btn-info')) }}
                        @endif
                        {{ HTML::linkRoute('clientes_pagos_codigo.get','Usar código',$pago->id,array('class'=>'btn btn-sm btn-success')) }}                   
                        
                        {{ HTML::linkRoute('clientes_pagos_pagar.get','Activación automática',$pago->id,array('class'=>'btn btn-sm btn-success')) }}
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
              
</script>

@stop
