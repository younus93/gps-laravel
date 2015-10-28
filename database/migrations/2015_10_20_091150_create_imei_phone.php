<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImeiPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imei_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imei');
            $table->string('vehicle_number');
            $table->string('phone_number');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('imei_recharge',function (Blueprint $table){
            $table->increments('id');
            $table->integer('imei_id')->unsigned();
            $table->timestamp('recharge_date');
            $table->string('transaction_id')->nullable();
            $table->string('recharge_method');
            $table->foreign('imei_id')->references('id')->on('imei_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imei_recharge');
        Schema::drop('imei_user');
        Schema::drop('users');
    }
}
