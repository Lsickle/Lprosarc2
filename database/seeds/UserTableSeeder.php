<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();
        $role_jlogistica = Role::where('name','jefelogistica')->first();
        $role_joperacion = Role::where('name','jefeoperacion')->first();
        $role_suser = Role::where('name','superuser')->first();

        $user = new User();
        $user->name = 'Luis';
        $user->email = 'suser@mail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_suser);

        $user = new User();
        $user->name = 'User';
        $user->email = 'User@mail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'jefelogistica';
        $user->email = 'jlogistica@mail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_jlogistica);

        $user = new User();
        $user->name = 'jefeoperacion';
        $user->email = 'joperacion@mail.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_joperacion);
    }
}
