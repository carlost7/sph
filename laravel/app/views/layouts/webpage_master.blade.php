<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
      <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <title>
                  @section('title')
                  {{ (isset($titulo))?$titulo:'Sphellar'}}
                  @show
            </title>
            <meta name="description" content="">            
            <meta name="viewport" content="width=device-width, initial-scale=1">
            {{ HTML::script('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') }}
            {{ HTML::style('css/bootstrap.css') }}
            {{ HTML::style('css/bootstrap-theme.css') }}
            {{ HTML::style('css/colors-override.css') }}
            {{ HTML::style('css/bootstrap-clockpicker.min.css') }}
            {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
            {{ HTML::style('css/autocomplete.css') }}
            {{ HTML::style('css/main.css') }}     
            
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway" type="text/css">
            
            <script>
                  var base_url = '{{ URL::to("/") }}';                  
            </script>
      </head>
      <body>
            <!-- Google Tag Manager -->
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NBKFNQ"
                              height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <script>(function(w, d, s, l, i) {
                        w[l] = w[l] || [];
                        w[l].push({'gtm.start':
                                      new Date().getTime(), event: 'gtm.js'});
                        var f = d.getElementsByTagName(s)[0],
                                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                        j.async = true;
                        j.src =
                                '//www.googletagmanager.com/gtm.js?id=' + i + dl;
                        f.parentNode.insertBefore(j, f);
                  })(window, document, 'script', 'dataLayer', 'GTM-NBKFNQ');</script>
            <!-- End Google Tag Manager -->
            <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                
                
                <!-- HEADER -->
                
                <div id="contenedorHEADER">

                        <ul class="menuHEADER">
                            <li><a href="http://sphellar.com/mx/"><img src="img/logotipo.png" alt="Logotipo Sphellar"/></a></li>

                           <li><a href="http://sphellar.com/mx/destinos.html">DESTINOS</a></li>
                           <li><a href="http://sphellar.com/mx/cultura.html">CULTURA</a>
                              <ul>
                                   <li><a href="http://sphellar.com/mx/cultura/musica.html">Música</a></li>
                                   <li><a href="http://sphellar.com/mx/cultura/cine.html">Cine</a></li>
                                   <li><a href="http://sphellar.com/mx/cultura/arte.html">Arte</a></li>
                                   <li><a href="http://sphellar.com/mx/cultura/moda.html">Moda</a></li>
                                   <li><a href="http://sphellar.com/mx/cultura/literatura.html">Literatura</a></li>
                                   <li><a href="http://sphellar.com/mx/cultura/gastronomia.html">Gatronomía</a></li>
                              </ul>
                           </li>
                           <li><a href="http://sphellar.com/mx/deportes.html">DEPORTES</a>
                              <ul>
                                  <li><a href="http://sphellar.com/mx/deportes/noticias.html">Noticias</a></li>
                                  <li><a href="http://sphellar.com/mx/deportes/atletas.html">Atletas</a></li>
                                  <li><a href="http://sphellar.com/mx/deportes/tips-deportivos.html">Tips Deportivos</a></li>
                                  <li><a href="http://sphellar.com/mx/deportes/zonas-extremas.html">Zonas extremas</a></li>
                              </ul>
                           </li>
                           <li><a href="http://sphellar.com/mx/eventos.html">EVENTOS</a></li>
                           <li><a class="estoy"href="http://sphellar.com/mx/guia/">GUÍA</a></li>
                        </ul>
                    
                    
                                <!-- FORM DE BUSCADOR -->

                                    {{ Form::open(array('route'=>'home','method'=>'get','class'=>'form_guia')) }}
                                            <div class="row">
                                                  <div class="col-sm-4">
                                                        <div class="form-group">
                                                              <!-- {{ Form::label('estado', 'Estado') }} -->
                                                              {{ Form::text('estado',Session::get('tipolocal'),array('class'=>'form-control big-input','id'=>'local','placeholder'=>'Estado')) }}
                                                              <input type="hidden" value="" name="tipolocal" id='tipolocal'>                  
                                                        </div>                  
                                                  </div>
                                                  <div class="col-sm-4">
                                                        <div class="form-group">
                                                              <!-- {{ Form::label('categoria', 'Categoría') }} -->
                                                              {{ Form::text('categoria',Session::get('tipocat'),array('class'=>'form-control','id'=>'cat','placeholder'=>'Categoría')) }}
                                                              <input type="hidden" value="" name="tipocat" id='tipocat'>                  
                                                        </div>         
                                                  </div>
                                                 <div class="col-sm-4">
                                                        <div class="form-group">
                                                              <button type="submit" class="btn btn-primary" id="btn_guia">BUSCAR</button>
                                                        </div>                 
                                                  </div>
                                                
                                            </div>
                                           
                                    {{ Form::close() }}
                                    
                    </div>
                
               
                
                <!-- MEN{U ESPECIAL DE LA GUÍA -->
                
                 <div class="navbar-collapse collapse">
                              <ul class="nav navbar-nav navbar-right">

                                    @if(Auth::check())
                                    <li class="dropdown">                                          
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <span class="caret"></span></a>
                                          <ul class="dropdown-menu" role="menu">
                                                @if(Auth::user()->userable_type === 'Cliente')
                                                <li>{{ HTML::linkRoute('clientes.index','Publicar') }}</li> 
                                                @elseif(Auth::user()->userable_type === 'Administrador')
                                                <li>{{ HTML::linkRoute('administradores.index','Administradores') }}</li> 
                                                @elseif(Auth::user()->userable_type === 'Marketing')
                                                <li>{{ HTML::linkRoute('marketing.index','Marketing') }}</li> 
                                                @elseif(Auth::user()->userable_type === 'Miembro')
                                                <li>{{ HTML::linkRoute('miembros.show','Usuario',Auth::user()->userable->id) }}</li> 
                                                @endif
                                                <li>{{ HTML::linkRoute('session.destroy','Salir') }}</li>
                                          </ul>
                                    </li>
                                    @else
                                    <li>{{ HTML::linkRoute('session.create','Entrar')}}</li>
                                    <li class="dropdown">                                          
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registrate <span class="caret"></span></a>
                                          <ul class="dropdown-menu" role="menu">
                                                <li>{{ HTML::linkRoute('register.user','Usuario') }}</li>
                                                <li>{{ HTML::linkRoute('register.client','Cliente') }}</li>
                                          </ul>
                                    </li>
                                    @endif
                              </ul>
                        </div><!--/.navbar-collapse -->
                
                      
                <div class="container">
                       
                      
        
                      
                      
                      <!-- <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                              </button>

                              {{ HTML::Link('/','Sphellar',array('class'=>'navbar-brand')) }}                    

                        </div> -->
                      
                      
                       
                  </div>
            </div>
            <div class="clearfix"></div>
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
            
            @yield('wrapper')

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>                
            {{ HTML::script('js/vendor/bootstrap.min.js') }}
            {{ HTML::script('js/vendor/jquery.autocomplete.js') }}
            {{ HTML::script('js/main.js') }}
            @section('scripts')
            @show
      </body>
</html>
