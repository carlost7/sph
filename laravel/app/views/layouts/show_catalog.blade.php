
@if($action == 'negocio')
{{ Form::open(array('route'=>'negocios.index','method'=>'get','id'=>'form_catalog')) }}
@else
{{ Form::open(array('route'=>'eventos.index','method'=>'get','id'=>'form_catalog')) }}
@endif
<div class="form-group">
    
    <section class="invisible_form">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('estado','Estado')}}
                  {{ Form::select('estado', $estados->lists('estado','id'),null,array('class'=>'form-control guia_buscador','id'=>'estados','placeholder'=>'¿Dónde?')) }}
            </div>
            <div class="col-sm-12">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),null,array('class'=>'form-control guia_buscador', 'id'=>'zonas','placeholder'=>'¿Qué buscas?')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),null,array('class'=>'form-control guia_buscador','id'=>'categorias')) }}
            </div>
            <div class="col-sm-12">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array(), null,array('class'=>'form-control guia_buscador', 'id'=>'subcats')) }}
            </div>
      </div>      
      <div class="row">
            <div class="col-sm-6">
                  <div class="radio">
                        <label id="search_negocio">
                              {{ Form::checkbox('negocios',true,($action=='negocio')?true:false,array('id'=>'busca_negocio', 'class'=>'radio_guia_buscador')) }}            
                              Negocios
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="radio">
                        <label id="search_cartelera">
                              {{ Form::checkbox('cartelera',true,($action=='cartelera')?true:false,array('id'=>'busca_cartelera', 'class'=>'radio_guia_buscador')) }}
                              Cartelera
                        </label>
                  </div>
            </div>
      </div>
      <input type="hidden" value="{{Session::get('categoria_id')}}" name="id_categoria" id='id_categoria_form'>
      <input type="hidden" value="{{Session::get('ubicacion_id')}}" name="id_ubicacion" id='id_ubicacion_form'>      
</div>
<div class="form-group center">
      <button type="submit" class="btn btn-primary btn_guia" id='search_catalog'>Buscar</button>      
</div>  

</section>
{{ Form::close() }}

