<?php

class HomeController extends BaseController
{
      /*
        |--------------------------------------------------------------------------
        | Default Home Controller
        |--------------------------------------------------------------------------
        |
        | You may wish to use controllers instead of, or in addition to, Closure
        | based routes. That's great! Here is an example controller method to
        | get you started. To route to this controller, just add the route:
        |
        |	Route::get('/', 'HomeController@showWelcome');
        |
       */

      public function showWelcome()
      {
            return View::make('hello');
      }

      //show login view
      public function showLogin()
      {
            // show the form
            return View::make('login');
      }

      //Log user
      public function doLogin()
      {
            // validate the info, create rules for the inputs
            $rules = array(
                'email' => 'required|email', // make sure the email is an actual email
                'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 6 characters
            );

            // run the validation rules on the inputs from the form
            $validator = Validator::make(Input::all(), $rules);

            // if the validator fails, redirect back to the form
            if ($validator->fails())
            {
                  return Redirect::to('login')
                                  ->withErrors($validator) // send back all errors to the login form
                                  ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            }
            else
            {

                  // create our user data for the authentication
                  $userdata = array(
                      'email' => Input::get('email'),
                      'password' => Input::get('password')
                  );

                  // attempt to do the login
                  if (Auth::attempt($userdata))
                  {

                        // validation successful!
                        // redirect them to the secure section or whatever
                        // return Redirect::to('secure');
                        // for now we'll just echo success (even though echoing in a controller is bad)
                        echo 'SUCCESS!';
                  }
                  else
                  {

                        // validation not successful, send back to form	
                        Session::flash('error', 'Email or password incorrect, try again');
                        return Redirect::to('login');
                  }
            }
      }

      public function doLogout()
      {
            Auth::logout(); // log the user out of our application
            return Redirect::to('/'); // redirect the user to the login screen
      }

}
