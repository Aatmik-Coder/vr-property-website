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
        Schema::create('image_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained('images')->onUpdate('cascade')->onDelete('cascade');
            $table->float('final_amount',18,2)->default(0);
            $table->float('amount',18,2)->nullable();
            $table->float('discount',18,2)->default(0);
            $table->string('discount_code')->nullable();
            $table->float('discount_per',18,2)->default(0);
            $table->string('payment_id')->nullable();
            $table->date('paid_start_date')->nullable();
            $table->date('paid_end_date')->nullable();
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
        Schema::dropIfExists('image_payments');
    }
};
