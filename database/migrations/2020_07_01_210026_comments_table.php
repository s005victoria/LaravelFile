<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')s->on('users');

            $table->integer('shopping_list_id')->unsigned();
            $table->foreign('shopping_list_id')->references('id')
                ->on('shopping_lists')
                ->onDelete('cascade');

            $table->string('text');

            //only needed if the messagefeature on navigationbar is implemented
            //$table->boolean('read')->default(false);
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
        Schema::dropIfExists('comments');
    }
}
