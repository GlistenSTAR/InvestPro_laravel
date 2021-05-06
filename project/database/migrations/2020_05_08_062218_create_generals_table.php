<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('web_name',50)->default('Banking E-Wallet')->nullable();
            $table->string('currency',50)->default('USD')->nullable();
            $table->string('color_code',50)->default('#fff')->nullable();
            $table->string('contact_address')->default('Berlin,Germany')->nullable();
            $table->string('contact_email')->default('support@example.com')->nullable();
            $table->string('contact_phone')->default('0123654789')->nullable();
            $table->string('copyright_text',255)->default('All Rights Reserved')->nullable();
            $table->string('banner_header',255)->nullable();
            $table->string('banner_body',255)->nullable();
            $table->string('banner_footer',255)->nullable();
            $table->string('about_head',255)->nullable();
            $table->string('about_title',255)->nullable();
            $table->longText('about_body')->nullable();
            $table->string('about_video_url')->nullable();

            $table->string('single_about1_icon',255)->nullable();
            $table->string('single_about1_title',255)->nullable();
            $table->longText('single_about1_description')->nullable();

            $table->string('single_about2_icon',255)->nullable();
            $table->string('single_about2_title',255)->nullable();
            $table->longText('single_about2_description')->nullable();

            $table->string('invest_head',255)->nullable();
            $table->string('invest_title',255)->nullable();
            $table->text('invest_description')->nullable();

            $table->string('investor_head',255)->nullable();
            $table->string('investor_title',255)->nullable();
            $table->text('investor_description')->nullable();

            $table->text('footer_text')->nullable();

            $table->text('email_template')->nullable();
            $table->text('sms_api')->nullable();


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
        Schema::dropIfExists('generals');
    }
}
