<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateTypesTable extends Migration
{
    public function up()
    {
        Schema::create('real_estate_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_english')->nullable();
            $table->string('name_arabic')->nullable();
            $table->string('name_kurdish')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
