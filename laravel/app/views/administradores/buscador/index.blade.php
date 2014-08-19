@extends('layouts.admin_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('administradores_buscador.create','Agregar categoria') }}</li>            
      </ul>      
</div>



@stop