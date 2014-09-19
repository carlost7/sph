@extends('layouts.webpage_master')


@section('wrapper')
<div class="container">
      <div class="row">
            <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                  <ul class="nav nav-pills">
                        <li @if($section === 'Miembro') class='active' @endif>{{ HTML::linkRoute('miembros.show','Cuenta',Auth::user()->userable->id) }}</li>
                  </ul>
            </div>
            <div class="col-md-3 hidden-xs">
                  <ul class="nav nav-pills nav-stacked">
                        <li @if($section === 'Miembro') class='active' @endif>{{ HTML::linkRoute('miembros.show','Cuenta',Auth::user()->userable->id) }}</li>
                  </ul>
            </div>
            <div class="col-xs-12 col-md-8 col-md-push-1">
                  @if(Session::has('message'))
                  <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('message') }}
                        {{ Session::forget('message'); }}        
                  </div>                        
                  @endif
                  @if(Session::has('error'))
                  <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error') }}
                        {{ Session::forget('error'); }}
                  </div>                    
                  @endif
                  @yield('content')
            </div>
      </div>
</div> <!-- /container -->        

@stop