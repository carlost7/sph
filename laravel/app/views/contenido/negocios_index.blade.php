@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog',array('action'=>'negocio'))

      <div class="row">
            <h2>Negocios</h2>
            @foreach($negocios as $negocio)
            <div class="col-sm-12">
                  @if(count($negocio->imagen))
                  <a href="{{ route('negocios.show',$negocio->id) }}"><img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" /></a>
                  @else
                  <a href="{{ route('negocios.show',$negocio->id) }}">{{HTML::image('img/default.png')}}</a>
                  @endif
                  <h3><strong>{{ HTML::linkRoute('negocios.show',$negocio->nombre,$negocio->id) }}</strong></h3>
                  <hr />
                  <p>Categoria: {{ $negocio->categoria->categoria }}</p>
                  @if(count($negocio->subcategoria))
                  <p>Subcategoria: {{ $negocio->subcategoria->subcategoria }}</p>
                  @endif
                  <hr />                  
                  <p>Estado: {{ $negocio->estado->estado }}</p>
                  @if(count($negocio->zona))
                  <p>Zona: {{ $negocio->zona->zona }}</p>
                  @endif
                  <hr />                  
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

@section('scripts')

{{ HTML::script('js/vendor/getCatalog.js') }}

@stop