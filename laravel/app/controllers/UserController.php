<?php

use Sph\Storage\User\UserRepository as User;

class UserController extends \BaseController
{

      protected $user;

      public function __construct(User $user)
      {
            parent::__construct();
            $this->user = $user;
      }

      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index()
      {
            return $this->user->all();
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return Response
       */
      public function register()
      {
            return View::make('user.create');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @return Response
       */
      public function store()
      {
            $v = new \Sph\Services\Validators\User;
            if ($v->passes())
            {
                  //$this->user->create($input);
            }
            else
            {
                  return Redirect::back()->withInput()->withErrors($v->getErrors());
            }
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            //
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            //
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            //
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            //
      }

}
