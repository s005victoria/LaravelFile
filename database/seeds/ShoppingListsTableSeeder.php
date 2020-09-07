<?php

use Illuminate\Database\Seeder;

class ShoppingListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoppingList1 = new \App\ShoppingList;
        $shoppingList1->title = 'Bitte auf die günstigsten Preise achten';

        //set foreignkey to liststatus and listuser
        $listState = App\State::find(2);
        $shoppingList1->state()->associate($listState);
        $listUser = App\User::all()->first();
        $shoppingList1->user()->associate($listUser);
        $shoppingList1->volunteer_id = 2;
        $shoppingList1->until = new DateTime();
        $shoppingList1->save();


        $shoppingList2 = new \App\ShoppingList;
        $shoppingList2->title = 'Wichtig: Auf laktosefreie Produkte achten';

        //set foreignkey to liststatus and listuser
        $listState2 = App\State::all()->first();
        $shoppingList2->state()->associate($listState2);
        $listUser2 = App\User::where('id', 3)->first();
        $shoppingList2->user()->associate($listUser2);
        $shoppingList2->title = 'Ein Bioeinkauf Bitte';
        $shoppingList2->until = new DateTime();
        $shoppingList2->save();


        $shoppingList3 = new \App\ShoppingList;
        $shoppingList3->title = 'Produkte mit möglichst wenig Zucker bitte!';

        //set foreignkey to liststatus and listuser
        $listState2 = App\State::find(3);
        $shoppingList3->state()->associate($listState2);
        $listUser2 = App\User::where('id', 3)->first();

        $shoppingList3->user()->associate($listUser2);
        $shoppingList3->title = 'Produkte mit möglichst wenig Zucker bitte!';
        $volunteer_user = App\User::where('id', 2)->first();
        $shoppingList3->volunteer()->associate($volunteer_user);
        $shoppingList3->until = new DateTime();
        $shoppingList3->save();





    }
}
