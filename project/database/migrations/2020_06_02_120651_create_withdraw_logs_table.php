<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_logs', function (Blueprint $table) {
            $table->id();
            $table->string('withdraw_id');
            $table->bigInteger('user_id');
            $table->string('amount');
            $table->string('charge');
            $table->string('method_name');
            $table->string('processing_time');
            $table->string('detail')->nullable();
            $table->integer('status')->comment('0 = pending, 1 = approved, 2 = Reject');
            $table->string('method_cur');
            $table->string('method_rate')->default(1);
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
        Schema::dropIfExists('withdraw_logs');
    }
}
