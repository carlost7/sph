<?php

use Sph\Storage\User\UserRepository as User;

class SessionController extends \BaseController
{

        protected $user;

        public function __construct(User $user)
        {
                $this->user = $user;
        }

        /**
         * Display a listing of the resource.
         * GET /session
         *
         * @return Response
         */
        public function create()
        {
                return View::make('session.create');
        }

        /**
         * Store a newly created resource in storage.
         * POST /session
         *
         * @return Response
         */
        public function store()
        {
                if (Auth::attempt(array('email' => Input::get('email'), 
                                        'password' => Input::get('password'))))
                {
                        return Redirect::intended('/');
                }
                return Redirect::route('session.create')
                                ->withInput()
                                ->with('login_errors', true);
        }

        /**
         * Remove the specified resource from storage.
         * DELETE /session/{id}
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
                Auth::logout();
                return View::make('session.destroy');
        }

}
