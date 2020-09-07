<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commi1 = new \App\Comment;
        $user =App\User::find(1);
        $commi1->user()->associate($user);
        $commi1->text = 'Bitte Discountprodukte kaufen';

       // $articleList = App\Unit::all()->first();
        //set relation to foreign key of unit
        //$commi1->Shoppinglist()->associate($articleList);
        $commi1->shopping_list_id = 1;

        $commi1->save();
    }
}
