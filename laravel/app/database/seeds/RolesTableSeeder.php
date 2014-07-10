<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RolesTableSeeder
 *
 * @author carlos
 */
class RolesTableSeeder extends Seeder {
      public function run()
      {
            DB::table('roles')->delete();
            
            $roles = array(
                  array(
                        "id" => 1,
                        "role" => "Administrador",                            
                  ),
                  array(
                        "id" => 2,
                        "role" => "Marketing"
                  ),
                  array(
                        "id" => 3,
                        "role" => "Usuario",
                  )
                  
            );
            foreach ($roles as $role)
            {
                  Role::create($role);
            }
      }
}
