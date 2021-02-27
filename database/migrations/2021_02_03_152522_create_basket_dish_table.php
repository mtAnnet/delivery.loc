<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketDishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_dish', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned();
            $table->integer('dish_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('dish_id')
                ->references('id')->on('dishes')
                ->onDelete('cascade');
            $table->foreign('basket_id')
                ->references('id')->on('baskets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basket_dish');
    }
}
