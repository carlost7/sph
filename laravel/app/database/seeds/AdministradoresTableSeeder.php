<?php

// Composer: "fzaninotto/faker": "v1.4.0"

class AdministradoresTableSeeder extends Seeder {

      public function run()
      {

            $admin            = new Administrador;
            $admin->nombre    = 'admin';
            $admin->is_activo = true;
            $admin->save();


            $user                        = new User;
            $user->password              = "passwordsphellar";
            $user->password_confirmation = "passwordsphellar";
            $user->email                 = "admin@sphellar.com";
            $admin->user()->save($user);
      }

}
