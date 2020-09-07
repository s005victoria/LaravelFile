<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShoppingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            //primary key -> increments
            //Namen-konventionen unbedingt einhalten !!
            $table->increments('id');

            //foreignkey zur user tabelle
            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')
                ->on('states');

            $table->integer('volunteer_id')->nullable();

            $table->string('title');
            $table->date('until');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_lists');
    }
}
