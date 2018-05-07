<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('meal_name');
            $table->integer('rating')->default(0);
            $table->decimal('meal_price');
            $table->string('description');
            $table->integer('mouth_count')->default(0);
            $table->string('tips');
            $table->integer('satisfy_count')->default(0);
            $table->integer('satisfy_rate')->default(0);
            $table->string('meal_img');
            $table->integer('shop_id')->unsigned();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->integer('food_cat_id')->unsigned();
            $table->foreign('food_cat_id')->references('id')->on('food_cats');
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
        Schema::dropIfExists('meals');
    }
}
