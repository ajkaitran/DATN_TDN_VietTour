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
        Schema::create('start_places', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->integer('sort');
            $table->boolean('active');
            $table->boolean('hot');
            $table->string('title', 100)->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('start_places');
    }
};
