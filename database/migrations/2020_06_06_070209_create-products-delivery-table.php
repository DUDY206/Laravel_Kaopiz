<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products-delivery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_ID');
            $table->foreign('user_ID')->references('id')->on('users');
            $table->integer('voucher_amount');
            $table->dateTime('date_init');
            $table->smallInteger('status');
            $table->string('customer_name');
            $table->string('customer_phoneNumber');
            $table->string('customer_address');
            $table->dateTime('finished_date');
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
        Schema::dropIfExists('products-delivery');
    }
}
