<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_english')->nullable();
            $table->string('title_arabic')->nullable();
            $table->string('title_kurdish')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->longText('description_english')->nullable();
            $table->longText('description_arabic')->nullable();
            $table->longText('description_kurdish')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
