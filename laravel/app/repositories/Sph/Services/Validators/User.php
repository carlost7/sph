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
class User extends Validator
{

        public static $rules = array(
            "save" => array(
                'email' => 'required|email|unique:users,email',
                'password' => 'required||alpha_dash|min:6',
                'password_confirm' => 'required|same:password',
            ),
            "update" => array(
                'email' => 'email',
                'password' => 'alpha_dash|min:6',
                'password_confirm' => 'same:password',
            ),
        );

}
