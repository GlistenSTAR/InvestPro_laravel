<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatwaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gatways', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('minimum_deposit_amount')->default(1);;
            $table->string('maximum_deposit_amount')->default(100);
            $table->string('fixed_charge')->default(0);
            $table->string('percentage_charge')->default(0);
            $table->string('rate')->default(1);
            $table->string('gateway_key_one')->nullable();
            $table->string('gateway_key_two')->nullable();
            $table->string('gateway_key_three')->nullable();
            $table->string('gateway_key_four')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('payment_gatways');
    }
}
