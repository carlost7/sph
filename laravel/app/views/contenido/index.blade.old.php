@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog')

      <div class="row">
            <div class="col-sm-8">
                  <h1>{{HTML::linkRoute('negocios.index','Negocios')}}</h1>
                  @foreach($negocios as $negocio)
                  <div class="col-sm-6">
                        @if(count($negocio->imagen))
                        <a href="{{ route('negocios.show',$negocio->id) }}"><img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('negocios.show',$negocio->id) }}">{{HTML::image('img/default.png')}}</a>
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
            <div class="col-sm-4">
                  <h1>{{HTML::linkRoute('eventos.index','Eventos')}}</h1>
                  @foreach($eventos as $evento)
                  <div class="col-sm-12">
                        @if(count($evento->imagen))
                        <a href="{{ route('eventos.show',$evento->id) }}"><img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('eventos.show',$evento->id) }}">{{HTML::image('img/default.png')}}</a>
                        @endif
                        <h2>{{HTML::linkRoute('eventos.show',$evento->nombre,$evento->id) }}</h2>
                        <hr />
                        <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
                        <hr />                  
                        <p>Zona: {{ $evento->zona->zona }}</p>
                        <p>Dirección: {{ $evento->direccion }}</p>
                        @if(count($evento->especial))
                        <p>Web: <a href="{{$evento->especial->web}}">{{$evento->nombre}}</a></p>
                        @endif


                  </div>
                  @endforeach                  
            </div>
      </div>
      <div class="row">
            <div class="col-sm-8">
                  <div class="text-center">
                        {{ $negocios->links()}}      
                  </div>                  
            </div>    

            <div class="col-sm-4">
                  <div class="text-center">
                        {{ $eventos->links()}}      
                  </div>                  
            </div>            

      </div>


</div>



@stop