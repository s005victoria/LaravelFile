<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('shopping_list_id')->unsigned();
            $table->foreign('shopping_list_id')->references('id')
                ->on('shopping_lists')
                ->onDelete('cascade');

            $table->string('title');
            $table->integer('amount')->nullable();
            $table->decimal('max_price')->nullable();
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
        Schema::dropIfExists('articles');
    }
}


