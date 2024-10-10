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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 100);
            $table->string('description', 500);
            $table->text('body')->nullable();
            $table->string('address', 500);
            $table->string('email', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->decimal('price', 18, 2)->nullable();
            $table->decimal('price_sale', 18, 2)->nullable();
            $table->integer('star');
            $table->text('image')->nullable();
            $table->dateTime('create_date');
            $table->integer('hotel_category_id');
            $table->boolean('active');
            $table->string('url', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
