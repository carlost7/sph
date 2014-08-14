<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTest
 *
 * @author carlos
 */
class UserTest extends TestCase
{

      public function testThatWeCanSaveTheUser()
      {
            $user = new User();
            $user->nombre = 'Carlos';
            $user->email = 'email@mail.com';
            $user->telefono = '56909233';
            $user->is_activo = true;
            $user->save();
            $this->assertTrue(true);
      }

}
