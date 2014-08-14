@extends('layouts.client_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_eventos.create','Agregar evento') }}</li>            
      </ul>
</div>

<h2>Lista de eventos</h2>

@if($eventos->count())

<div class="list-group">
      @foreach($eventos as $evento)

      <div class="list-group-item {{ $evento->publicar ? 'published' : 'not-published' }}">
            <h3 class="text-left">                  
                  {{ HTML::linkRoute("clientes_eventos.show",$evento->nombre,$evento->id) }}
            </h3>
            <p>{{ date('d-m-Y',strtotime($evento->inicio)).' - '.date('d-m-Y',strtotime($evento->fin)) }}</p>
            @if(!$evento->is_activo && !$evento->fecha_nueva_activacion)
            <p class="text-right">
                  {{ HTML::linkRoute('clientes_eventos_activar.get','Activar',$evento->id,array('class'=>'btn btn-sm btn-warning')) }}       
            </p>
            @endif
            @if($evento->is_especial  && !$evento->especial )
            <p class="text-right">
                  {{ HTML::linkRoute('clientes_eventos.edit','Agregar datos especiales',$evento->id,array('class'=>'btn btn-sm btn-success')) }}       
            </p>
            @endif
            <p class="text-right">
                  {{ HTML::linkRoute('clientes_eventos.edit','editar',$evento->id,array('class'=>'btn btn-sm btn-info')) }}                         
            </p>


            {{ Form::open(array('route' => array('clientes_eventos.destroy',$evento->id))) }}            
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }}</p>
            {{ Form::close() }}                        

      </div>

      @endforeach
</div>

@else

<h3>Aún no has agregado ningún evento</h3>

@endif


@stop