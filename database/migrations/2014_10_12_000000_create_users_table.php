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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id');
            $table->boolean('is_developer')->nullable()->default(false);
            $table->boolean('is_agency')->nullable()->default(false);
            $table->boolean('is_employee')->nullable()->default(false);
            $table->unsignedInteger('developer_id')->nullable();
            $table->unsignedInteger('agency_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('users');
    }
};
