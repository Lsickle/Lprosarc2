<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\sede;
use App\cliente;

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
        factory(App\cliente::class, 120)->create()->each(function(App\cliente $Cli){
            $id= $Cli->ID_Cli;
            $count=0;
            $countsede=$count++;
            $Cli->sede()->saveMany(factory(App\sede::class, 5)->make([
                'Cliente' => $id,   
                'ID_Sede' => null,/*function($countsede) {
                    return $countsede;
                    $countsede++;
                    }*/
                ])
            );
        });
    }
}
