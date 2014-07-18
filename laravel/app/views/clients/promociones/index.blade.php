@extends('layouts.client_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_promociones.create','Agregar promoción') }}</li>            
      </ul>
</div>

<h2>Lista de promociones</h2>

@if($promociones->count())

<ul class="list-group">
      @foreach($promociones as $promocion)

      <li class="list-group-item">
            <h3 class="text-left">                  
                  {{ HTML::linkRoute("clientes_promociones.show",$promocion->nombre,$promocion->id) }}                  
            </h3>
            <p>{{ date('d-m-Y',strtotime($promocion->inicio)).' - '.date('d-m-Y',strtotime($promocion->fin)) }}</p>
            <p class="text-right">
                  {{ HTML::linkRoute('clientes_promociones.edit','editar',$promocion->id,array('class'=>'btn btn-sm btn-info')) }}       
            </p>

            {{ Form::open(array('route' => array('clientes_promociones.destroy',$promocion->id))) }}            
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }} </p>
            {{ Form::close() }}                        

      </li>

      @endforeach
</ul>

@else

<h3>Aún no has agregado ningúna promocion</h3>

@endif


@stop