<?php

use Sph\Storage\User\UserRepository as User;
use Sph\Storage\Marketing\MarketingRepository as Marketing;

class MarketingController extends \BaseController
{

      protected $user;
      protected $marketing;

      public function __construct(User $user, Marketing $marketing)
      {
            $this->user = $user;
            $this->marketing = $marketing;
            View::share('section','Marketing');
      }

      /**
       * Display a listing of marketing
       *
       * @return Response
       */
      public function index()
      {
            return View::make('marketing.index');
      }

      /**
       * Show the form for editing the specified marketing.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit()
      {
            return View::make('marketing.edit');
      }

      /**
       * Update the specified marketing in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update()
      {
            $validateUser = new Sph\Services\Validators\User(Input::all(), 'update');
            $validateMarketing = new Sph\Services\Validators\Marketing(Input::all(), 'update');

            if ($validateUser->passes() & $validateMarketing->passes())
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
                        $marketing_model = array();
                        if ("" !== Input::get('nombre'))
                        {
                              $marketing_model = array_add($marketing_model, "name", Input::get('nombre'));
                        }
                        if ("" !== Input::get('telefono'))
                        {
                              $marketing_model = array_add($marketing_model, "telephone", Input::get('telefono'));
                        }
                        $marketing = $this->marketing->update(Auth::user()->userable->id, $marketing_model);
                        if (isset($marketing))
                        {
                              Session::flash('message', 'Usuario modificado con éxito');
                              return Redirect::route('marketing.index');
                        }
                  }
            }
            $user_messages = ($validateUser->getErrors() != null) ? $validateUser->getErrors()->all() : array();
            $marketing_messages = ($validateMarketing->getErrors() != null) ? $validateMarketing->getErrors()->all() : array();
            $validationMessages = array_merge_recursive($user_messages, $marketing_messages);

            return Redirect::back()->withInput()->withErrors($validationMessages);
      }

      /**
       * Remove the specified marketing from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Marketing::destroy($id);

            return Redirect::route('marketing.index');
      }

}
