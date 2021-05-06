<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToGenerals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->string('esender')->nullable();
            $table->text('comment_script')->nullable();
            $table->string('bal_trans_fixed_charge')->default(0);
            $table->string('bal_trans_percentage_charge')->default(0);
            $table->boolean('email_verification')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generals', function (Blueprint $table) {
            $table->dropColumn('esender');
            $table->dropColumn('comment_script');
            $table->dropColumn('bal_trans_fixed_charge');
            $table->dropColumn('bal_trans_percentage_charge');
            $table->dropColumn('email_verification');
        });
    }
}
