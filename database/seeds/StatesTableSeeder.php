<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusOpen = new \App\State;
        $statusOpen->name = 'open';
        $statusOpen->save();

        $statusProgress = new \App\State;
        $statusProgress->name = 'inprogress';
        $statusProgress->save();

        $statusDone = new \App\State;
        $statusDone->name = 'done';
        $statusDone->save();
    }
}
