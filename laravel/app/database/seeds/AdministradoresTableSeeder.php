<?php

// Composer: "fzaninotto/faker": "v1.4.0"

class AdministradoresTableSeeder extends Seeder {

	public function run()
      {

            $admin1 = new Administrador();
            $admin1->nombre = 'admin';
            $admin1->is_activo = true;
            $admin1->save();

            $user1 = new User();
            $user1->password = Hash::make('klendactu');
            $user1->email = 'admin@sphellar.com';
            $user1->userable_id = $admin1->id;
            $user1->userable_type = get_class($admin1);
            $user1->save();

            
      }

}
