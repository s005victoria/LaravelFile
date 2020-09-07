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
        $user = new App\User;
        $user->firstname = 'Sepp';
        $user->lastname = 'Müller';
        $user->address = 'Feldweg 3';
        $user->email = 'sepp@hilfesuchend.at';
        $user->password = bcrypt('secret');
        $user->volunteer=0;
        $user->save();

        $user = new App\User;
        $user->firstname = 'Franziska';
        $user->lastname = 'Wallner';
        $user->address = 'Feldweg 10';
        $user->email = 'franzi@helferin.at';
        $user->password = bcrypt('secret');
        $user->volunteer=1;
        $user->save();

        $user = new App\User;
        $user->firstname = 'Wilhelm';
        $user->lastname = 'Kofler';
        $user->address = 'Feldweg 7';
        $user->email = 'wilhelm@hilfesuchender.at';
        $user->password = bcrypt('secret');
        $user->volunteer=0;
        $user->save();

    }
}
