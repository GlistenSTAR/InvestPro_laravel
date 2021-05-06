<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('main_name')->nullable();
            $table->string('name');
            $table->string('minamo')->nullable();
            $table->string('maxamo')->nullable();
            $table->string('fixed_charge')->nullable();
            $table->string('percent_charge')->nullable();
            $table->string('rate')->nullable();
            $table->string('val1')->nullable();
            $table->string('val2')->nullable();
            $table->string('val3')->nullable()->comment('	paytm Website');
            $table->string('val4')->nullable()->comment('	paytm Industry Type');
            $table->string('val5')->nullable()->comment('paytm Channel ID');
            $table->string('val6')->nullable()->comment('paytm Transaction URL');
            $table->string('val7')->nullable()->comment('paytm Transaction Status URL');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('gateways');
    }
}
