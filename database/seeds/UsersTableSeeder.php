<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=100; $i++){
            $usersFactory= factory(\App\User::class)->make();
            $user= new \App\User();
            $user->name=$usersFactory->name;
            $user->email=$usersFactory->email;
            $user->password=$usersFactory->password;
            $user->save();
        }
    }
}
