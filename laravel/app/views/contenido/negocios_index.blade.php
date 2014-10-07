@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog',array('action'=>'negocio'))

      <div class="row">
          <h2 class="title_index">Negocios</h2>
            @foreach($negocios as $negocio)
            <div class="col-sm-6 sin_padding cuadro_front_negocios">
                  @if(count($negocio->imagen))
                  <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}"><img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" /></a>
                  @else
                  <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}">{{HTML::image('img/negocio-default.jpg')}}</a>
                  @endif
                  <h3 class="title_negocio"><strong>{{ HTML::linkRoute('negocios.show',$negocio->nombre,array($negocio->id,Str::slug($negocio->nombre))) }}</strong></h3>
                  
                  <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($negocio->categoria->categoria).".png") }}</p>
                        
                       
                        @if(count($negocio->subcategoria))
                        <p><span class="info_guia">Subcategoria:</span> {{ $negocio->subcategoria->subcategoria }}</p>
                        @endif
                                   
                  
                                 
                  
                  
                  <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $negocio->descripcion }}</p>
                        
                        
                        
                        <table width="100%" border="0" class="tabla_negocios">
                            
                        <tr>
                                
                        <td>
                            
                            @if(count($negocio->masInfo))
                        @if($negocio->masInfo->efectivo)
                        {{HTML::image('img/si_no/efectivo_si.png')}}
                        @else
                        {{HTML::image('img/si_no/efectivo_no.png')}}
                        @endif
                        
                        </td>
                        
                        <td>
                            
                            
                        @if($negocio->masInfo->tc)
                        {{HTML::image('img/si_no/tarjeta_si.png')}}
                        @else
                        {{HTML::image('img/si_no/tarjeta_no.png')}}
                        @endif
                       
                        </td>
                                
                        <td>
                       
                        @if($negocio->masInfo->llevar)
                        {{HTML::image('img/si_no/llevar_si.png')}}
                        @else
                        {{HTML::image('img/si_no/llevar_no.png')}}
                        @endif
                        @endif
                        </td>
                        
                        </tr>
                         </table>


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
