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

    public function run() {
        DB::table('users')->delete();
        User::create(array(
            'email' => 'info@sphellar.com',
            'password' => Hash::make('carlos'),
            'role_id' => 1,
            'is_activo' => true
        ));
        User::create(array(
            'email' => 'carlos.juarez@t7marketing.com',
            'password' => Hash::make('carlos'),
            'role_id' => 2,
            'is_activo' => true
        ));
        User::create(array(
            'email' => 'carlos.juarez@wortev.com',
            'password' => Hash::make('carlos'),
            'role_id' => 3,
            'is_activo' => false
        ));
    }

}
