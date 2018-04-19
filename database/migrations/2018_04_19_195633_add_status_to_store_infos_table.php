<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToStoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建审核状态字段
        Schema::table('store_infos',function (Blueprint $table){
            $table->tinyInteger('status')->defalut(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除审核状态字段
        Schema::table('store_infos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
