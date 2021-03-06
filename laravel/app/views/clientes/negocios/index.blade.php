@extends('layouts.client_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('publicar.clientes_negocios.create','Agregar negocio') }}</li>            
      </ul>
</div>

<h2>Lista de negocios</h2>

@if($negocios->count())

<div class="list-group">
      @foreach($negocios as $negocio)

      <div class="list-group-item {{ $negocio->publicar ? 'published' : 'not-published' }}">
            <h3 class="text-left">                  
                  {{ HTML::linkRoute("publicar.clientes_negocios.show",$negocio->nombre,$negocio->id) }}
            </h3>
            @if($negocio->is_activo && $negocio->fecha_nueva_activacion)
            
            @if(Carbon\Carbon::now()->gte(Carbon\Carbon::createFromFormat("Y-m-d", $negocio->fecha_nueva_activacion)))
            <p class="text-right">
                  {{ HTML::linkRoute('publicar.clientes_negocios_activar.get','Activar',$negocio->id,array('class'=>'btn btn-sm btn-warning')) }}       
            </p>
            @endif
            @endif
            <p class="text-right">
                  {{ HTML::linkRoute('publicar.clientes_negocios.edit','editar',$negocio->id,array('class'=>'btn btn-sm btn-info')) }}       
            </p>
            <p class="text-right">
                  {{ HTML::linkRoute('publicar.clientes_negocio_imagenes.index','editar imagenes',$negocio->id,array('class'=>'btn btn-sm btn-info')) }}       
            </p>

            {{ Form::open(array('route' => array('publicar.clientes_negocios.destroy',$negocio->id))) }}            
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }} </p>
            {{ Form::close() }}                        

      </div>

      @endforeach
</div>
@else
<h3>Aún no has agregado ningún negocio</h3>

@endif


@stop