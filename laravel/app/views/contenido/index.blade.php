@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('estado', 'Estado') }}
                  {{ Form::text('estado',null,array('class'=>'form-control big-input','id'=>'local')) }}
                  <input type="text" value="" name="tipolocal" id='tipolocal'>
                  <input type="text" value="" name="valorlocal">
            </div>                  
      </div>
      <div class="col-sm-6">
            <div class="form-group">
                  {{ Form::label('categoria', 'Categoria') }}
                  {{ Form::text('categoria',null,array('class'=>'form-control','id'=>'cat')) }}
                  <input type="text" value="" name="tipocat" id='tipocat'>
                  <input type="text" value="" name="valorcat">
            </div>         
      </div>
</div>

@stop

@section('scripts')

<script>
      $("#local").autocomplete({            
            serviceUrl: base_url + "/catalogo_zonas",
            onSelect: function(suggestion) {
                  $("#tipolocal").val(suggestion.data);
            }
      });
      
      $("#cat").autocomplete({            
            serviceUrl: base_url + "/catalogo_categorias",
            onSelect: function(suggestion) {
                  $("#tipocat").val(suggestion.data);
            }
      });
</script>

@stop