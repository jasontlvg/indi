<?php

use Illuminate\Database\Seeder;
use App\fakeUser;

class fakeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<50; $i++){
            $fakeUser= new fakeUser;
            $fakeUser->name= 'Jason';
            $fakeUser->email= 'jason@gmail.com';
            $fakeUser->phone= '9700261';
            $fakeUser->save();

        }

    }
}
