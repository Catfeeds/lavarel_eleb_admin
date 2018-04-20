<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFengniaoToStoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_infos',function (Blueprint $table){
            $table->tinyInteger('fengniao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除外键字段
        Schema::table('store_infos', function (Blueprint $table) {
            $table->dropColumn('fengniao');
        });
    }
}
