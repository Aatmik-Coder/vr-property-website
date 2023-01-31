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
            $table->float('amount',18,2)->nullable();
            $table->float('final_amount',18,2)->default(0);
            $table->float('discount',18,2)->default(0);
            $table->string('discount_code')->nullable();
            $table->float('discount_per',18,2)->default(0);
            $table->string('payment_id')->nullable();
            $table->enum('status',['Approve','Decline'])->nullable();
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
