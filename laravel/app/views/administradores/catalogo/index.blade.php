@extends('layouts.admin_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('administrador_catalogo.create','Agregar datos') }}</li>            
      </ul>      
</div>



@stop