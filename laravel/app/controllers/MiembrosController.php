<?php

use Sph\Storage\Miembro\MiembroRepository as Miembro;
use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Negocio\NegocioRepository as Negocio;
use Sph\Storage\Evento\EventoRepository as Evento;
use Sph\Storage\Rank\RankRepository as Rank;

class MiembrosController extends \BaseController
{

      protected $miembro;
      protected $user;
      protected $negocio;
      protected $evento;
      protected $rank;

      public function __construct(Miembro $miembro, User $user, Negocio $negocio, Evento $evento, Rank $rank)
      {
            parent::__construct();
            $this->miembro = $miembro;
            $this->user = $user;
            $this->evento = $evento;
            $this->negocio = $negocio;
            $this->rank = $rank;
            View::share('section', 'Miembro');
      }

      /**
       * Display the specified miembro.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $miembro = $this->miembro->find($id);
            return View::make('miembros.show')->with(array('miembro' => $miembro));
      }

      /**
       * Show the form for editing the specified miembro.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $miembro = $this->miembro->find($id);

            return View::make('miembros.edit')->with(array('miembro' => $miembro));
      }

      /**
       * Update the specified miembro in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'update');
            $validateMiembro = new Sph\Services\Validators\Miembro(Input::all(), 'update');
            $input = array('imagen' => Input::File('imagen'));
            $validatorImagen = new Sph\Services\Validators\Imagen_perfil($input, 'save');

            if ($validateUser->passes() & $validateMiembro->passes())
            {
                  $user_model = array();
                  if ("" !== Input::get('password'))
                  {
                        $user_model = array_add($user_model, "password", Input::get('password'));
                  }
                  if ("" !== Input::get('email'))
                  {
                        $user_model = array_add($user_model, "email", Input::get('email'));
                  }
                  $user = $this->user->update(Auth::user()->id, $user_model);
                  if (isset($user))
                  {
                        $miembro_model = Input::all();

                        if ($input['imagen'])
                        {
                              //Obtener datos de la imagen
                              $path = strval(Auth::user()->id) . '/';
                              $nombre = Auth::user()->userable->id . sha1(time()) . '.' . $input['imagen']->getClientOriginalExtension();
                              $miembro_model = array_add($miembro_model, 'path', $path);
                              $miembro_model = array_add($miembro_model, 'nombre_imagen', $nombre);
                        }

                        $miembro = $this->miembro->update($id, $miembro_model);

                        if (isset($miembro))
                        {
                              if ($input['imagen'])
                              {
                                    //Guardar la imagen; 
                                    $path = Config::get('params.usrimg') . $path;
                                    try
                                    {
                                          $input['imagen']->move($path, $miembro->imagen->nombre);
                                    } catch (Exception $e)
                                    {
                                          Log::error('MiembrosController.edit: ' . print_r($e, true));
                                          Session::flash('message', 'Error al modificar el usuario, intentelo de nuevo');
                                    }
                              }
                              Session::flash('message', 'Usuario modificado con éxito');
                              return Redirect::route('miembros.show', $id);
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $miembro_messages = ($validateMiembro->getErrors() != null) ? $validateMiembro->getErrors()->all() : array();
            $imagen_messages = ($validatorImagen->getErrors() != null) ? $validatorImagen->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $miembro_messages, $imagen_messages);

            return Redirect::back()->withInput()->withErrors($validationMessages);
      }

      /**
       * Remove the specified miembro from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Miembro::destroy($id);

            return Redirect::route('miembros.index');
      }

      public function add_rank($tipo, $id)
      {
            $tipo = strtolower($tipo);

            $rankedObject = $this->$tipo->find($id);

            if (isset($rankedObject))
            {
                  
                  //Checa si el usuario ya tiene el objet
                  if ($tipo == "negocio")
                  {

                        $ranks = Auth::user()->userable->ranknegocios->filter(function($ranknegocio) use($id)
                        {
                              return $ranknegocio->negocio_id == $id;
                        });
                        
                        dd($ranks);
                        
                        if(count($ranks->negocio)){
                              $resultado = array('error'=>true,'mensaje'=>'Ya habias rankeado esto antes');
                              return Response::json($resultado);
                        }                              
                        
                  }
                  else
                  {

                        echo "no";
                        /* if(Auth::user()->userable->ranknegocios->contains($id)){

                          } */
                  }

                  $objeto = $this->$tipo->agregar_rank($id,Auth::user()->userable);

                  $resultado = array('mensaje' => 'Agregado con exito', 'rank' => $rankedObject->rank);
            }
            else
            {
                  $resultado = array('mensaje', 'No existe el objeto para rankear');
            }

            return Response::json($resultado);
      }

}
