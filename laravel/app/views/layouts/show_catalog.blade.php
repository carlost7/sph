<div class="row">
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('categoria', 'Categoria') }}
                  {{ Form::select('categoria', $categorias,null,array('class'=>'form-control')) }}
            </div>                  
      </div>
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('estado', 'Estado') }}
                  {{ Form::select('estado', $estados,null,array('class'=>'form-control')) }}
            </div>                  
      </div>
</div>
