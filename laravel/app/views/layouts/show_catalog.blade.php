{{ Form::open(array('route'=>'home','method'=>'get')) }}
<div class="row">
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('estado', 'Estado') }}
                  {{ Form::text('estado',null,array('class'=>'form-control big-input','id'=>'local')) }}
                  <input type="hidden" value="" name="tipolocal" id='tipolocal'>                  
            </div>                  
      </div>
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('categoria', 'Categoria') }}
                  {{ Form::text('categoria',null,array('class'=>'form-control','id'=>'cat')) }}
                  <input type="hidden" value="" name="tipocat" id='tipocat'>                  
            </div>         
      </div>
</div>
<div class="row">
      <div class="col-sm-12">
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Buscar</button>
            </div>                 
      </div>
</div>
{{ Form::close() }}