<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\sede;
use App\cliente;
use App\generador;
use App\GenerSede;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   

        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(clientesTableSeeder::class);
        $this->call(generadorsTableSeeder::class);
    }
}
