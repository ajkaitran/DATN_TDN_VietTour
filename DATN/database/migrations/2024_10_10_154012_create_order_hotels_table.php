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
        Schema::create('order_hotels', function (Blueprint $table) {
            $table->id();
            $table->boolean('payment');
            $table->dateTime('transport_date');
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->integer('status');
            $table->boolean('viewed');
            $table->text('discount_code')->nullable();
            $table->string('customer_info_hotel_full_name', 50);
            $table->string('customer_info_hotel_address', 200)->nullable();
            $table->string('customer_info_hotel_email', 50)->nullable();
            $table->string('customer_info_hotel_body', 50)->nullable();
            $table->string('customer_info_hotel_phone', 50)->nullable();
            $table->integer('hotel_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_hotels');
    }
};
