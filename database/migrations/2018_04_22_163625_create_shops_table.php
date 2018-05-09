<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->float('shop_rating')->default(0.0);
            $table->tinyInteger('brand');
            $table->tinyInteger('on_time');
            $table->tinyInteger('bao');
            $table->tinyInteger('piao');
            $table->tinyInteger('zhun');
            $table->tinyInteger('fengniao');
            $table->decimal('start_send');
            $table->decimal('send_cost');
            $table->integer('distance');
            $table->integer('estimate_time');
            $table->string('notice');
            $table->string('discount');
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
        Schema::dropIfExists('shops');
    }
}
