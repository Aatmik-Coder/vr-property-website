<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_login');
            $table->unsignedInteger('login_id');
            $table->unsignedSmallInteger('country_id');
            $table->unsignedInteger('state_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('project_name');
            $table->enum('unit_type', ['Residential', 'Commercial','Other Property Type']);
            $table->string('type_of_building');
            $table->enum('unit_number',['1 Bhk','2 Bhk','3 Bhk','4 Bhk','5 Bhk', '5 Bhk+'])->nullable();
            $table->string('size');
            $table->string('price');
            $table->string('description');
            $table->string('image_name')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
