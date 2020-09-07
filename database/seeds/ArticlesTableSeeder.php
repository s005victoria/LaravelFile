<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $article = new \App\Article;
        $article->title ='Zahnpasta';
        $article->amount = '2';

        //TODO beziehung zu list
        $article->max_price = 1000;
        $article->shopping_list_id = 1;


        //$articleList = App\Unit::all()->first();
        //set relation to foreign key of unit
       // $article->shoppingList()->associate($articleList);

        $article->save();

    }
}
