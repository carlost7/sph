<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTableSeeder
 *
 * @author carlos
 */
class UserTableSeeder extends Seeder {

      public function run()
      {
            DB::table('users')->delete();
		User::create(array(			
			'username' => 'carlos',
			'email'    => 'info@sphellar.com',
			'password' => Hash::make('carlos'),
		));
      }

}
