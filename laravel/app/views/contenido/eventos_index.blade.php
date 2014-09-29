@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog',array('action'=>'evento'))
      <div class="row">
            <div class="col-sm-4">
                  <h2>Cartelera</h2>
                  @foreach($eventos as $evento)
                  <div class="col-sm-12">
                        @if(count($evento->imagen))
                        <a href="{{ route('eventos.show',$evento->id) }}"><img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('eventos.show',$evento->id) }}">{{HTML::image('img/default.png')}}</a>
                        @endif
                        <h3><strong>{{HTML::linkRoute('eventos.show',$evento->nombre,$evento->id) }}</strong></h3>
                        <hr />
                        <p>Categoria: {{ $evento->categoria->categoria }}</p>
                        @if(count($evento->subcategoria))
                        <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
                        @endif

                        <hr />                  
                        <p>Estado: {{ $evento->estado->estado }}</p>
                        @if(count($evento->subcategoria))
                        <p>Zona: {{ $evento->zona->zona }}</p>
                        @endif
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

@section('scripts')
{{ HTML::script('js/vendor/getCatalog.js') }}
@stop