<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename_ar');
            $table->string('sitename_en');
            $table->string('email')->nullable();
            $table->enum('main_lang', ['en', 'ar', 'fr'])->default('en');
            $table->enum('status', ['open', 'close'])->default('open');
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('msg_maintenance')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
