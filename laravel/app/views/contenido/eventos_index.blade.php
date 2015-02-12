@extends('layouts.webpage_master')

@section('wrapper')
<div class="container total">
      <div id="cartelera_opcion_interna">

            <section class="invisible_interna color">

                  <a href="{{ URL::route('negocios.index') }}">

                        <p>Cartelera</p>
                  </a>

            </section>

      </div>



      @include('layouts.show_catalog',array('action'=>'cartelera'))



      <!-- PUBLICIDAD BANNER GRANDE -->

      <article id="publicidad_uno_interna">

            <article>

                  <a href="http://sphellar.com/mx/ target="new">
                     {{HTML::image('img/publicidad/banner_publicidad_3.jpg','Publicidad Sphellar')}}   
                  </a>

            </article>

      </article>


@include('layouts.show_last_posts')


<!-- Comienza sección de Cartelera -->

@if(count($eventos))
<div class="row">

      @foreach($eventos as $evento)
      <div class="col-sm-6 cuadro_front_negocios">
            @if($evento->imagen_file_name != "")
            <img src="{{ URL::to("/").$evento->imagen->url('medium')}}">
            @else
            <a href="{{ route('eventos.show',array($evento->id,Str::slug($evento->nombre))) }}">{{HTML::image('img/evento-default.jpg')}}</a>
            @endif
            <h3  class="title_cartelera"><strong>{{HTML::linkRoute('eventos.show',$evento->nombre,array($evento->id,Str::slug($evento->nombre))) }}</strong></h3>

            <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($evento->categoria->categoria).".png",$evento->categoria->categoria,array('title'=>$evento->categoria->categoria,'data-toggle'=>'tooltip','data-placement'=>'bottom')) }}</p>
            @if(count($evento->subcategoria))
            <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
            @endif


            <table width="100%" border="0" class="tabla_cartelera">

                  <tr>

                        <td>

                              @if(count($evento->masInfo))
                              @if($evento->masInfo->efectivo)
                              {{HTML::image('img/si_no/cartelera/efectivo_si.png','Se acepta efectivo',array('title'=>'Se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @else
                              {{HTML::image('img/si_no/cartelera/efectivo_no.png','No se acepta efectivo',array('title'=>'No se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @endif

                        </td>

                        <td>


                              @if($evento->masInfo->tc)
                              {{HTML::image('img/si_no/cartelera/tarjeta_si.png','Se acepta tarjeta de crédito',array('title'=>'Se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @else
                              {{HTML::image('img/si_no/cartelera/tarjeta_no.png','No se acepta tarjeta de crédito',array('title'=>'No se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @endif

                        </td>

                        <td>

                              @if($evento->masInfo->alcohol)
                              {{HTML::image('img/si_no/cartelera/alcohol_si.png','El evento cuenta con alcohol',array('title'=>'El evento cuenta con alcohol','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @else
                              {{HTML::image('img/si_no/cartelera/alcohol_no.png','El evento no cuenta con alcohol',array('title'=>'El evento no cuenta con alcohol','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                              @endif
                              @endif
                        </td>

                  </tr>
            </table>


            <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $evento->descripcion }}</p>



      </div>
      @endforeach                  
</div>

<div class="row">
      <div class="col-sm-12">
            <div class="text-center">
                  {{ $eventos->links()}}      
            </div>                  
      </div>            

</div>
@else
<div class="row">
      <div class="col-sm-12">
            <div class="text-center">
                  <h1>No se encontraron resultados para tu busqueda, si conoces alguno agregalo</h1>
            </div>                  
      </div>            

</div>
@endif
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
