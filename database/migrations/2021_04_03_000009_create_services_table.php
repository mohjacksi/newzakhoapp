<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_english')->nullable();
            $table->string('title_arabic')->nullable();
            $table->string('title_kurdish')->nullable();
            $table->longText('description_english')->nullable();
            $table->longText('description_arabic')->nullable();
            $table->longText('description_kurdish')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
