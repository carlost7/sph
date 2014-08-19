@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'clientes_negocios.store', 'files'=>true)) }}

<div class="form-group">
      {{ Form::label('nombre', 'Nombre') }}
      {{ Form::text('nombre', Input::old('nombre'), array('placeholder' => 'nombre del negocio', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('telefono', 'Teléfono') }}
      {{ Form::text('telefono', Input::old('telefono'), array('placeholder' => 'teléfono', 'class'=>'form-control')) }}
</div>
<div class="form-group">
      {{ Form::label('direccion', 'Dirección') }}
      {{ Form::text('direccion', Input::old('direccion'), array('placeholder' => 'dirección', 'class'=>'form-control')) }}
</div>        
<div class="form-group">
      {{ Form::label('descripcion', 'Descripción') }}
      {{ Form::textArea('descripcion', Input::old('descripcion'), array('placeholder' => 'descripcion', 'class'=>'form-control')) }}
</div>


<div class="form-group">
      {{ Form::label('llevar','Más información') }}
      <div class="row">
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('domicilio',1) }}            
                              ¿Entregan a domicilio?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox('llevar',1) }}                       
                              ¿Servicio para llevar?
                        </label>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="checkbox">
                        <label>                              
                              {{ Form::checkbox('familiar',1) }}                       
                              ¿Ambiente familiar?
                        </label>
                  </div>
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('alcohol',1) }}            
                              ¿Cuenta con alcohol?
                        </label>
                  </div>
            </div>

      </div>      
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('moneda','Moneda') }}
                  {{ Form::select('moneda', array('MEX' => 'Pesos', 'USD' => 'Dolares'),null,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('rango_min','Rango de precios mínimo') }}
                  {{ Form::text('rango_min', Input::old('rango_min'), array('placeholder' => '00.00', 'class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('rango_max','Rango de precios máximo') }}
                  {{ Form::text('rango_max', Input::old('rango_max'), array('placeholder' => '00.00', 'class'=>'form-control')) }}
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('pagos','Pagos Aceptados') }}
            </div>            
      </div>
      <div class="row">
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('tc', true) }}      
                              Tarjeta de crédito
                        </label>
                  </div>

            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('td', true) }}      
                              Tarjeta de debito
                        </label>
                  </div>
            </div>
            <div class="col-sm-4">
                  <div class="checkbox">
                        <label>
                              {{ Form::checkbox('efectivo', true) }}
                              Efectivo
                        </label>                        
                  </div>
            </div>
      </div>
</div>
<div class="form-group">      
      <div class="row">
            <div class="col-sm-6">
                  <div class="row">
                        <div class="col-sm-12">
                              {{ Form::label('horario','Horarios') }}
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('lun-ini','Lunes inicio') }}
                              <div class="bfh-timepicker" data-name='lun-ini' data-time='{{ Input::old('lun-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('lun-fin','Lunes fin') }}
                              <div class="bfh-timepicker" data-name='lun-ini' data-align='right' data-time='{{ Input::old('lun-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('mar-ini','Martes inicio') }}
                              <div class="bfh-timepicker" data-name='mar-ini' data-time='{{ Input::old('mar-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('mar-fin','Martes fin') }}
                              <div class="bfh-timepicker" data-name='mar-fin' data-align='right' data-time='{{ Input::old('mar-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('mie-ini','Miercoles inicio') }}
                              <div class="bfh-timepicker" data-name='mie-ini' data-time='{{ Input::old('mie-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('mie-fin','Miercoles fin') }}
                              <div class="bfh-timepicker" data-name='mie-fin' data-align='right' data-time='{{ Input::old('mie-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('jue-ini','Jueves inicio') }}
                              <div class="bfh-timepicker" data-name='jue-ini' data-time='{{ Input::old('jue-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('jue-fin','Jueves fin') }}
                              <div class="bfh-timepicker" data-name='jue-fin' data-align='right' data-time='{{ Input::old('jue-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('vie-ini','Viernes inicio') }}
                              <div class="bfh-timepicker" data-name='vie-ini' data-time='{{ Input::old('vie-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('vie-fin','Viernes fin') }}
                              <div class="bfh-timepicker" data-name='vie-fin' data-align='right' data-time='{{ Input::old('vie-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('sab-ini','Sabado inicio') }}
                              <div class="bfh-timepicker" data-name='sab-ini' data-time='{{ Input::old('sab-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('sab-fin','Sabado fin') }}
                              <div class="bfh-timepicker" data-name='sab-fin' data-align='right' data-time='{{ Input::old('sab-fin')}}'>
                              </div>                              
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-sm-6">
                              {{ Form::label('dom-ini','Domingo inicio') }}
                              <div class="bfh-timepicker" data-name='dom-ini' data-time='{{ Input::old('dom-ini')}}'>
                              </div>                              
                        </div>
                        <div class="col-sm-6">
                              {{ Form::label('dom-fin','Domingo fin') }}
                              <div class="bfh-timepicker" data-name='dom-fin' data-align='right' data-time='{{ Input::old('dom-fin')}}'>
                              </div>                              
                        </div>
                  </div>      
            </div>
            <div class="col-sm-6">
                  {{ Form::label('imagen','Imágen') }}
                  <input type="file" name="imagen" id='uploadFile' title="Seleccionar" class="file-inputs" data-filename-placement="inside">
                  <div id="imagepreview" class="imagepreview"></div>
                  {{ Form::label('alt','Descripción') }}
                  {{ Form::text('alt',Input::old('alt'),array('placeholder' => 'descripción', 'class'=>'form-control')) }}
            </div>
      </div>
</div>
<div class="form-group">
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('estado','Estado') }}
                  {{ Form::select('estado', array('cats'=> array('leopard'=>'leopard','Guepard'=>'guepard')),null,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('zona','Zona') }}
                  {{ Form::select('zona', array('cats'=> array('leopard'=>'leopard','Guepard'=>'guepard')),null,array('class'=>'form-control')) }}
            </div>
      </div>
      <div class="row">
            <div class="col-sm-4">
                  {{ Form::label('categoria','Categoria') }}
                  {{ Form::select('categoria', array('cats'=> array('leopard'=>'leopard','Guepard'=>'guepard')),null,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-4">
                  {{ Form::label('subcategoria','subcategoria') }}
                  {{ Form::select('subcategoria', array('cats'=> array('leopard'=>'leopard','Guepard'=>'guepard')),null,array('class'=>'form-control')) }}
            </div>
      </div>
      
</div>

@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Crear negocio</button>
</div>        

{{ Form::close() }}

@stop

@section('scripts')
{{ HTML::script('js/vendor/bootstrap-file-input.js') }}
{{ HTML::script('js/vendor/ui.timepickr.js') }}

<script>
      $('.file-inputs').bootstrapFileInput();

      $(function() {
            $('#uploadFile').on("change", function() {
                  var files = !!this.files ? this.files : [];
                  if (!files.length || !window.FileReader)
                        return; // no file selected, or no FileReader support

                  if (/^image/.test(files[0].type)) { // only image file
                        var reader = new FileReader(); // instance of the FileReader
                        reader.readAsDataURL(files[0]); // read the local file

                        reader.onloadend = function() { // set image data as background of div
                              $("#imagepreview").css("background-image", "url(" + this.result + ")");
                        }
                  }
            });
      });

</script>
@stop