
@if($action == 'negocio')
{{ Form::open(array('route'=>'negocios.index','method'=>'get','id'=>'form_catalog')) }}
@else
{{ Form::open(array('route'=>'eventos.index','method'=>'get','id'=>'form_catalog')) }}
@endif
<div class="form-group">
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', $estados->lists('estado','id'),null,array('class'=>'form-control','id'=>'estados')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array(),null,array('class'=>'form-control', 'id'=>'zonas')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', $categorias->lists('categoria','id'),null,array('class'=>'form-control','id'=>'categorias')) }}
            </div>
            <div class="col-sm-6">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array(), null,array('class'=>'form-control', 'id'=>'subcats')) }}
            </div>
      </div>      
      <div class="row">
            <div class="col-sm-6">
                  <div class="radio">
                        <label id="search_negocio">
                              {{ Form::checkbox('negocios',true,($action=='negocio')?true:false,array('id'=>'busca_negocio')) }}            
                              Negocios
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="radio">
                        <label id="search_cartelera">
                              {{ Form::checkbox('cartelera',true,($action=='cartelera')?true:false,array('id'=>'busca_cartelera')) }}
                              Cartelera
                        </label>
                  </div>
            </div>
      </div>
</div>
<div class="form-group">
      <button type="submit" class="btn btn-primary" id='search_catalog'>Buscar</button>      
</div>        
{{ Form::close() }}

