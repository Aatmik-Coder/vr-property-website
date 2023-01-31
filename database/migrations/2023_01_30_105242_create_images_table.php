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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('images')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('file_name')->nullable();
            $table->bigInteger('size')->nullable()->comment('in bytes');
            $table->bigInteger('width')->nullable()->comment('in px');
            $table->bigInteger('height')->nullable()->comment('in px');
            $table->enum('status',['Approve','Decline'])->nullable();
            $table->date('paid_start_date')->nullable();
            $table->date('paid_end_date')->nullable();
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
