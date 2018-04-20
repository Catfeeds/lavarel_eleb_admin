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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('store_name');
            $table->string('store_img');
            $table->string('store_rating');
            $table->tinyInteger('brand');
            $table->tinyInteger('on_time');
            $table->tinyInteger('bao');
            $table->tinyInteger('piao');
            $table->tinyInteger('zhun');
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
        Schema::dropIfExists('store_infos');
    }
}
