<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('plan_name');
            $table->char('get_percent',4)->comment('% get every ROI');
            $table->integer('get_action')->nullable()->comment('plan wise action number');
            $table->integer('get_period')->comment('plan wise period:1=Hourly,24=Daily,168=Weekly,720=Monthly,2880=Quarterly,8640=Yearly');
            $table->integer('took_action')->default(0)->comment('already taken action');
            $table->string('invest_amount');
            $table->boolean('status')->comment('0 = Running, 1 = complete');
            $table->timestamp('next_time');
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
        Schema::dropIfExists('invest_logs');
    }
}
