<?php

namespace Sph\Services\Validators;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author carlos
 */
class Auth2 extends Validator
{

      public static $rules = array(
            "save" => array(
                  'email' => 'email|unique:users,email',
                  //'uid' => 'required|unique:users',
                  'oauth_token' => 'required',
                  'oauth_token_secret' => 'required',
            ),
            "update" => array(
                  'email' => 'email',
                  //'uid' => 'required|unique:users',
                  'oauth_token' => 'required',
                  //'oauth_token_secret' => 'required',
            ),
      );

}
