@extends('layouts.client_dashboard_master')


@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('publicar.clientes_negocios.create','Agregar negocio') }}</li>            
      </ul>
</div>

<h2>Lista de negocios</h2>

@if($negocios->count())

<ul class="list-group">
      @foreach($negocios as $negocio)

      <li class="list-group-item">
            <h3 class="text-left">                  
                  {{ HTML::linkRoute("publicar.clientes_negocios.show",$negocio->nombre,$negocio->id) }}
            </h3>
            <p class="text-right">
                  {{ HTML::linkRoute('publicar.clientes_negocios.edit','editar',$negocio->id,array('class'=>'btn btn-sm btn-info')) }}       
            </p>

            {{ Form::open(array('route' => array('publicar.clientes_negocios.destroy',$negocio->id))) }}            
            {{ Form::hidden('_method', 'DELETE') }}            
            <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }} </p>
            {{ Form::close() }}                        




      </li>

      @endforeach
</ul>

@endif



