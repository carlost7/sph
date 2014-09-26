@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">

      <!-- GALERIA -->

      <div class="slideshow" id="slideshow">
            <ol class="slides">
                  <li class="current">
                        <div class="description">
                              <h2>Categoria SPHELLAR 1</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview col">
                              <a href="#"><img src="img/1_screen.jpg"/></a>
                              <a href="#"><img src="img/2_screen.jpg"/></a>
                        </div>
                  </li>
                  <li>
                        <div class="description">
                              <h2>Categoria SPHELLAR 2</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview row">
                              <a href="#"><img src="img/3_mobile.jpg"/></a>
                              <a href="#"><img src="img/4_mobile.jpg"/></a>
                        </div>
                  </li>
                  <li>
                        <div class="description">
                              <h2>Categoria SPHELLAR 3</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview col">
                              <a href="#"><img src="img/5_screen.jpg"/></a>
                              <a href="#"><img src="img/6_screen.jpg"/></a>
                        </div>
                  </li>
                  <li>
                        <div class="description">
                              <h2>Categoria SPHELLAR 4</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview row">
                              <a href="#"><img src="img/1_mobile.jpg"/></a>
                              <a href="#"><img src="img/2_mobile.jpg"/></a>
                        </div>
                  </li>
                  <li>
                        <div class="description">
                              <h2>Categoria SPHELLAR 5</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview col">
                              <a href="#"><img src="img/3_screen.jpg"/></a>
                              <a href="#"><img src="img/4_screen.jpg"/></a>
                        </div>
                  </li>
                  <li>
                        <div class="description">
                              <h2>Categoria SPHELLAR 6</h2>
                              <p>Ejemplo de banner 1 en <a href="#">Sphellar</a>, podría venderse para publicidad.</p>
                        </div>
                        <div class="tiltview row">
                              <a href="#"><img src="img/5_mobile.jpg"/></a>
                              <a href="#"><img src="img/6_mobile.jpg"/></a>
                        </div>
                  </li>
            </ol>
      </div><!-- /slideshow -->

      <div class="row">
            <div class="col-sm-8">
                  <h2>Negocios</h2>
                  @foreach($negocios as $negocio)
                  <div class="col-sm-6">
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
            <div class="col-sm-8">
                  <div class="text-center">
                        {{ $negocios->links()}}      
                  </div>                  
            </div>    

      </div>


</div>



@stop


@section('scripts')

{{ HTML::script('js/vendor/galeria/classie.js') }}
{{ HTML::script('js/vendor/galeria/tiltSlider.js') }}




<script>
      new TiltSlider(document.getElementById('slideshow'));
</script>


@stop
