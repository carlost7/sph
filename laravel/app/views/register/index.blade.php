@extends('layouts.webpage_master')

@section('wrapper')
<div class="row">
      <div class="col-xs-6">
            <h1><span class="glyphicon glyphicon-star"></span></h1>
            {{ HTML::linkRoute('register.client','Clientes')  }}
      </div>
      <div class="col-xs-6">
            <h1><span class="glyphicon glyphicon-user"></span></h1>
            {{ HTML::linkRoute('register.user','Usuarios') }}
      </div>
</div>
@stop