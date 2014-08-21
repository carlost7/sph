<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
      <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>Sphellar</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            {{ HTML::style('css/bootstrap.css') }}
            {{ HTML::style('css/bootstrap-theme.css') }}            
            {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
            {{ HTML::style('css/bootstrap-formhelpers.min.css') }}
            {{ HTML::style('css/colors-override.css') }}            
            {{ HTML::style('css/main.css') }}
            {{ HTML::script('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
            <script>
                  var base_url = '{{ URL::to("/") }}';
            </script>
      </head>
      <body>
            <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                  <div class="container">
                        <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                              </button>
                              @if(Session::get('is_admin'))
                              {{ HTML::linkRoute('administradores.index','Sphellar',null,array('class'=>'navbar-brand')) }}
                              @else
                              {{ HTML::link('/','Sphellar',array('class'=>'navbar-brand')) }}
                              @endif                    
                        </div>
                        <div class="navbar-collapse collapse">
                              <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <span class="caret"></span></a>
                                          <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Contacto</a></li>                                
                                                <li class="divider"></li>
                                                <li>{{ HTML::linkRoute('session.destroy','Salir') }}</li>                                                                               
                                          </ul>
                                    </li>
                              </ul>
                        </div><!--/.navbar-collapse -->
                  </div>
            </div>

            <div class="clearfix"></div>
            <div class="container">
                  <div class="row">
                        <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                              <ul class="nav nav-pills">                                    
                                    <li {{ Request::is('administrador_catalogo*') ? "class='active'" : "" }}>{{ HTML::linkRoute('administrador_catalogo.index','Catálogo',null) }}</li>
                                    <li {{ Request::is('administradores*') ? "class='active'" : "" }}>{{ HTML::linkRoute('administradores.index','Cuenta',null) }}</li>
                              </ul>
                        </div>
                        <div class="col-md-3 hidden-xs">
                              <ul class="nav nav-pills nav-stacked">
                                    <li {{ Request::is('administrador_catalogo*') ? "class='active'" : "" }}>{{ HTML::linkRoute('administrador_catalogo.index','Catálogo',null) }}</li>
                                    <li {{ Request::is('administradores*') ? "class='active'" : "" }}>{{ HTML::linkRoute('administradores.index','Cuenta',null) }}</li>
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

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>                
            {{ HTML::script('js/vendor/bootstrap.min.js') }}
            {{ HTML::script('js/vendor/bootstrap-formhelpers.min.js') }}
            {{ HTML::script('js/main.js') }}
            @section('scripts')
            @show
      </body>
</html>