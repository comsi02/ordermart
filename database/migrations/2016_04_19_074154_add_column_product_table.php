<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('booked_cnt')->after('quantity')->unsigned()->default(0)->comment('판매완료된 count');
            $table->text('images')->after('status')->nullable()->comment('상품이미지');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('booked_cnt');
            $table->dropColumn('images');
        });
    }
}
