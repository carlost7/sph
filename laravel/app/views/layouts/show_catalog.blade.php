
@if($action == 'negocio')
{{ Form::open(array('route'=>'negocios.index','method'=>'get','id'=>'form_catalog')) }}
@else
{{ Form::open(array('route'=>'eventos.index','method'=>'get','id'=>'form_catalog')) }}
@endif
<div class="form-group">
      <section class="invisible_form">
            <div class="row">
                  <div class="col-sm-12">
                        {{ Form::label('estado_dd','Estado')}}
                        {{ Form::select('estado_dd', $estados->lists('estado','id'),Session::get('estados'),array('class'=>'form-control guia_buscador','id'=>'estados','placeholder'=>'¿Dónde?')) }}
                  </div>
                  <div class="col-sm-12">
                        {{ Form::label('zona_dd','Zona') }}
                        {{ Form::select('zona_dd',array(""=>""),"",array('class'=>'form-control guia_buscador', 'id'=>'zonas','placeholder'=>'¿Qué buscas?')) }}
                  </div>
            </div>
            <div class="row">
                  <div class="col-sm-12">
                        {{ Form::label('categoria_dd','Categoria') }}
                        {{ Form::select('categoria_dd', $categorias->lists('categoria','id'),Session::get('categorias'),array('class'=>'form-control guia_buscador','id'=>'categorias')) }}
                  </div>
                  <div class="col-sm-12">
                        {{ Form::label('subcategoria_dd','subcategoria') }}
                        {{ Form::select('subcategoria_dd', array(""=>""),"",array('class'=>'form-control guia_buscador', 'id'=>'subcats')) }}
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
            <input type="hidden" value="{{Session::get('id_ubicacion')}}" name="id_ubicacion" class="id_ubicacion">
            <input type="hidden" value="{{Session::get('id_categoria')}}" name="id_categoria" class="id_categoria">
      </section>
</div>
<div class="form-group center">
      <button type="submit" class="btn btn-primary btn_guia" id='search_catalog'>Buscar</button>      
</div>

{{ HTML::script('js/searchContentCatalog.js') }}

{{ Form::close() }}

