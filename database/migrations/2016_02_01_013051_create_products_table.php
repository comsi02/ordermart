<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('상품명');
            $table->text('desc')->commnet('상품설명');
            $table->integer('quantity')->unsigned()->comment('수량');
            $table->integer('user_id')->unsigned()->comment('영업사원');
            $table->string('status')->comment('상태');
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
        Schema::drop('products');
    }
}
