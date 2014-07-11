@extends('layouts.webpage_master')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <h1><span class="glyphicon glyphicon-home"></span></h1>
            {{ HTML::linkRoute('login.get','Entrar')  }}
        </div>
        <div class="col-xs-6">
            <h1><span class="glyphicon glyphicon-ok"></span></h1>
            {{ HTML::linkRoute('user.register','Registrarse') }}
        </div>
    </div>
@stop