@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      <!-- @include('layouts.show_catalog')-->
      <div class="row">
            <div class="col-sm-12">
                  <h1>Eventos</h1>
                  @foreach($eventos as $evento)
                  <div class="col-sm-6">
                        @if(count($evento->imagen))
                        <img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" />
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
            <div class="col-sm-12">
                  <div class="text-center">
                        {{ $eventos->links()}}      
                  </div>                  
            </div>            

      </div>


</div>



@stop