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
        Schema::create('start_days', function (Blueprint $table) {
            $table->id();
            $table->integer('product_schedule_id');
            $table->integer('product_id');
            $table->dateTime('date');
            $table->string('slot');
            $table->text('tran_sport')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price1')->nullable();
            $table->integer('price2')->nullable();
            $table->integer('price3')->nullable();
            $table->integer('price4')->nullable();
            $table->integer('price5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('start_days');
    }
};
