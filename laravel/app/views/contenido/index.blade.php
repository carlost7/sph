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

            <a href="http://sphellar.com/mx/" target="new">
                  {{HTML::image('img/publicidad/banner_publicidad_1.jpg','Publicidad Sphellar')}}   
            </a>

      </article>

</section>


@include("layouts.show_last_posts")

<!-- CONTENIDO DE NEGOCIOS Y EVENTOS -->



<div class="container total">


      <div class="row">
            @if(count($negocios))
            <div class="col-sm-8 sin_padding">
                <h2 class="title_index padding_especial"><span>Negocios</span></h2>
                  @foreach($negocios as $negocio)
                  <div class="col-sm-6 cuadro_front">

                        @if($negocio->imagen_file_name != "")
                        <img src="{{ URL::to("/").$negocio->imagen->url('medium')}}">
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
            @else
            <div class="col-sm-8 sin_padding">
                  <h2>No se encontraron negocios para tu busqueda, si conoces alguno compartenos</h2>
            </div>
            @endif
            <div class="col-sm-4 col_cartelera sin_padding">
                <h2 class="title_cartelera  padding_especial"><span>Cartelera</span></h2>
                  @foreach($eventos as $evento)
                  <div class="col-sm-12 cuadro_front especial">
                        @if($evento->imagen_file_name != "")
                          <img src="{{ URL::to("/").$evento->imagen->url('medium')}}">
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
                        {{ $negocios->appends(array('nombre_ubicacion'=>Session::get('ubicacion'),
                                            'id_ubicacion'=>Session::get('id_ubicacion'),
                                            'nombre_categoria'=>Session::get('categoria'),
                                            'id_categoria'=>Session::get('id_categoria')))->links()}}      
                  </div>                  
            </div>    

      </div>




</div>



@stop


@section('scripts')

{{ HTML::script('js/latest_posts.js') }}

<script>
      $(function () {
            $("[data-toggle='tooltip']").tooltip();
      });
</script>

@stop
