<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waiter_id');
            $table->unsignedBigInteger('reservation_id');
            $table->string('product_code');
            $table->integer('quantity');
            $table->text('allergies')->nullable();
            $table->timestamps();

            // Define foreign keys
            $table->foreign('waiter_id')->references('id')->on('users');
            $table->foreign('reservation_id')->references('id')->on('reservations');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
