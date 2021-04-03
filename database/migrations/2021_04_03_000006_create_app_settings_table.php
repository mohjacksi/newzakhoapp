<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->unique();
            $table->string('value_english')->nullable();
            $table->string('value_arabic')->nullable();
            $table->string('value_kurdish')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
