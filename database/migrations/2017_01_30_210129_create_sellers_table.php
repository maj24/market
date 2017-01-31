<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->timestamps();

            $table->integer('address_id')->unsigned()->nullable();
            $table->foreign('address_id')
                  ->references('id')
                  ->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
