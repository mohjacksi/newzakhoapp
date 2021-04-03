<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRealEstatesTable extends Migration
{
    public function up()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_3591369')->references('id')->on('real_estate_types');
        });
    }
}
