<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_infos', function (Blueprint $table) {
            $table->increments('store_id');
            $table->string('store_img');
            $table->string('store_rating')->defalut(0);
            $table->tinyInteger('brand')->defalut(0);
            $table->tinyInteger('on_time')->defalut(0);
            $table->tinyInteger('bao')->defalut(0);
            $table->tinyInteger('piao')->defalut(0);
            $table->tinyInteger('zhun')->defalut(0);
            $table->decimal('start_send')->defalut(20);
            $table->decimal('send_cost')->defalut(5);
            $table->integer('distance')->defalut(20);
            $table->integer('estimate_time')->defalut(0);
            $table->string('notice')->defalut('');
            $table->string('discount')->defalut('');
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
        Schema::dropIfExists('store_infos');
    }
}
