<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('min_amount')->nullable();
            $table->string('max_amount')->nullable();
            $table->string('fixed_amount')->nullable();
            $table->char('percent',4);
            $table->tinyInteger('action')->nullable();
            $table->integer('period')->comment('1=Hourly,24=Daily,168=Weekly,720=Monthly,2880=Quarterly,8640=Yearly');
            $table->boolean('return_time_status')->default(true)->comment('1 = ROI, 0 = Fixed');
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
        Schema::dropIfExists('plans');
    }
}
