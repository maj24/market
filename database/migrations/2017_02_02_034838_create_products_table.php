<?php

use Illuminate\Support\Facades\Schema;
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
         Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->string('description');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')
              ->references('id')
              ->on('sellers');
            $table->timestamps();
        });
        Schema::table('reviews', function($table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
              ->references('id')
              ->on('products')
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
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('products');
    }
}
