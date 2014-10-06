@extends('layouts.webpage_master')

@section('wrapper') 

<section id="btns_opcion">

      <div id="negocio_opcion">

            <section class="invisible">

                  <a href="{{ URL::route('negocios.index') }}">

                        <p>Negocios</p>
                  </a>

            </section>

      </div>

      <div id="cartelera_opcion">

            <section class="invisible color">

                  <a href="{{ URL::route('eventos.index') }}">

                        <p>Cartelera</p>
                  </a>

            </section>

      </div>

</section>

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




<section id="publicidad_tres">

      <article class="publi">

            <a href="#">
                  {{HTML::image('img/publicidad/cuadro_1.jpg','Publicidad uno')}} 
            </a>

      </article>

      <article class="publi">

            <a href="#">
                  {{HTML::image('img/publicidad/cuadro_2.jpg','Publicidad uno')}} 
            </a>

      </article>

      <article class="publi">

            <a href="#">
                  {{HTML::image('img/publicidad/cuadro_3.jpg','Publicidad uno')}} 
            </a>

      </article>

</section>






<div class="container">


      <div class="row">
            <div class="col-sm-8 sin_padding">
                  <h2 class="title_index">Negocios</h2>
                  @foreach($negocios as $negocio)
                  <div class="col-sm-6 cuadro_front">
                        @if(count($negocio->imagen))
                        <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}"><img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}">{{HTML::image('img/negocio-default.jpg')}}</a>
                        @endif
                        <h3 class="title_negocio"><strong>{{ HTML::linkRoute('negocios.show',$negocio->nombre,$negocio->id) }}</strong></h3>
                        <!--<hr /> -->
                        <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($negocio->categoria->categoria).".png") }}</p>
                        
                       
                        @if(count($negocio->subcategoria))
                        <p><span class="info_guia">Subcategoria:</span> {{ $negocio->subcategoria->subcategoria }}</p>
                        @endif

                        <!--<p><span class="info_guia">Estado:</span> {{ $negocio->estado->estado }}</p>
                        @if(count($negocio->zona))
                        <p><span class="info_guia">Zona:</span> {{ $negocio->zona->zona }}</p>
                        @endif-->

                        <p><span class="info_guia">Descripción:</span> {{ $negocio->descripcion }}</p>
                        <!--<p><span class="info_guia">Teléfono:</span> {{ $negocio->telefono }}</p>
                        @if(count($negocio->especial))
                        <p><span class="info_guia">Web:</span> <a href="{{$negocio->especial->webpage}}">{{$negocio->nombre}}</a></p>
                        @endif-->
                        
                        
                        @if(count($negocio->masInfo))
                        @if($negocio->masInfo->llevar)
                        {{HTML::image('img/si.png')}}
                        @else
                        {{HTML::image('img/no.png')}}
                        @endif
                        @endif


                  </div>
                  @endforeach                  

            </div>
            <div class="col-sm-4 col_cartelera sin_padding">
                  <h2 class="title_index">Cartelera</h2>
                  @foreach($eventos as $evento)
                  <div class="col-sm-12 cuadro_front especial">
                        @if(count($evento->imagen))
                        <a href="{{ route('eventos.show',array($evento->id,Str::slug($evento->nombre))) }}"><img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('eventos.show',array($evento->id,Str::slug($evento->nombre))) }}">{{HTML::image('img/evento-default.jpg')}}</a>
                        @endif
                        <h3  class="title_cartelera"><strong>{{HTML::linkRoute('eventos.show',$evento->nombre,$evento->id) }}</strong></h3>
                        
                        <p class="img_catego"><span class="info_guia">Categoria:</span> {{ HTML::image("img/Categorias-icons/".Str::slug($negocio->categoria->categoria).".png") }}</p>
                        @if(count($evento->subcategoria))
                        <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
                        @endif
               
                        <!--<p><span class="info_guia">Estado:</span> {{ $evento->estado->estado }}</p>
                        @if(count($evento->subcategoria))
                        <p><span class="info_guia">Zona:</span> {{ $evento->zona->zona }}</p>
                        @endif-->
                        
                        
                        <p><span class="info_guia">Dirección:</span> {{ $evento->direccion }}</p>
                        @if(count($evento->especial))
                        <p><span class="info_guia">Web:</span> <a href="{{$evento->especial->web}}">{{$evento->nombre}}</a></p>
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
