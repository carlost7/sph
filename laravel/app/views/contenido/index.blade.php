@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog')
      
      <div class="row">
            @foreach($negocios as $negocio)
            <div class="col-sm-4">
                  <h2>{{ $negocio->nombre }}</h2>
                  <p>Estado: {{ $negocio->estado->estado }}</p>
                  <p>Zona: {{ $negocio->zona->zona }}</p>
                  <p>Categoría: {{ $negocio->categoria->categoria }}</p>
                  <p>Subcategoria: {{ $negocio->subcategoria->subcategoria }}</p>
            </div>
            @endforeach
      </div>
      <div class="row">
            <div class="col-sm-12">
                  <div class="text-center">
                  {{ $negocios->links()}}      
                  </div>                  
            </div>            
      </div>


</div>



@stop