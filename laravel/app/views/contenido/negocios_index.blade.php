@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
    <!-- @include('layouts.show_catalog')-->

      <div class="row">
            @foreach($negocios as $negocio)
            <div class="col-sm-6">
                  @if(count($negocio->imagen))
                  <img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" />
                  @endif
                  <h2>{{ HTML::linkRoute('negocios.show',$negocio->nombre,$negocio->id) }}</h2>
                  <hr />
                  <p>Subcategoria: {{ $negocio->subcategoria->subcategoria }}</p>
                  <hr />                  
                  <p>Zona: {{ $negocio->zona->zona }}</p>
                  <p>Dirección: {{ $negocio->direccion }}</p>
                  <p>Teléfono: {{ $negocio->telefono }}</p>
                  @if(count($negocio->especial))
                  <p>Web: <a href="{{$negocio->especial->webpage}}">{{$negocio->nombre}}</a></p>
                  @endif

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