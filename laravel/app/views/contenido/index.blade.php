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

<!-- PUBLICIDAD BANNER GRANDE -->

<section id="publicidad_uno">
    
    <article>
        
        <a href="http://sphellar.com/mx/ target="new">
                  {{HTML::image('img/publicidad/banner_publicidad_1.jpg','Publicidad Sphellar')}}   
            </a>
        
    </article>

</section>


<!-- PUBLICIDAD BANNER CHICOS (3) -->

<section id="publicidad_tres">

      <article class="publi">

          <a href="http://sphellar.com/mx/cultura/arte/23-el-poder-de-las-tormentas-en-la-fotografia-de-mike-olbinski.html" target="new">
                  {{HTML::image('img/publicidad/cuadro_1default.jpg','Publicidad uno')}} 
            </a>

      </article>

      <article class="publi">

          <a href="http://sphellar.com/mx/cultura/22-los-4-alimentos-mas-caros-del-mundo.html" target="new">
                  {{HTML::image('img/publicidad/cuadro_2default.jpg','Publicidad uno')}} 
            </a>

      </article>

      <article class="publi">

          <a href="http://sphellar.com/mx/cultura/literatura/21-encuentros-literarios-en-el-hay-festival-xalapa.html" target="new">
                  {{HTML::image('img/publicidad/cuadro_3default.jpg','Publicidad uno')}} 
            </a>

      </article>

</section>


<!-- CONTENIDO DE NEGOCIOS Y EVENTOS -->



<div class="container total">


      <div class="row">
            <div class="col-sm-8 sin_padding">
                  <h2 class="title_index">Negocios</h2>
                  @foreach($negocios as $negocio)
                  <div class="col-sm-6 cuadro_front">
                        
                        @if(count($negocio->imagen))
                        <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}"><img src="{{ Image::path(Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre,'resize',250,250) }}" alt="{{ $negocio->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}">{{HTML::image('img/negocio-default.jpg')}}</a>
                        @endif
                        <h3 class="title_negocio"><strong>{{ HTML::linkRoute('negocios.show',$negocio->nombre,$negocio->id) }}</strong></h3>
                        <!--<hr /> -->
                        <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($negocio->categoria->categoria).".png",$negocio->categoria->categoria,array('title'=>$negocio->categoria->categoria,'data-toggle'=>'tooltip','data-placement'=>'bottom')) }}</p>
                        

                        @if(count($negocio->subcategoria))
                        <p><span class="info_guia">Subcategoria:</span> {{ $negocio->subcategoria->subcategoria }}</p>
                        @endif

                        <p class="txt_descripcion"><span class="info_guia">Teléfono:</span> {{ $negocio->telefono}}</p>
                        
                        <p class="txt_descripcion"><span class="info_guia">Dirección:</span> {{ $negocio->direccion }}</p>
                        
                        <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $negocio->descripcion}}</p>
                        

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
                        
                        <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($evento->categoria->categoria).".png",$evento->categoria->categoria,array('title'=>$evento->categoria->categoria,'data-toggle'=>'tooltip','data-placement'=>'bottom')) }}</p>
                        @if(count($evento->subcategoria))
                        <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
                        @endif

                        <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $evento->descripcion }}</p>
                                                
                        <p class="txt_descripcion"><span class="info_guia">Dirección:</span> {{ $evento->direccion }}</p>
                        
                        <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $evento->descripcion}}</p>
                        

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

<script>
   $(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>

@stop
