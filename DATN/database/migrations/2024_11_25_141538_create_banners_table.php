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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('banner_group');
            $table->string('banner_name', 100)->nullable();
            $table->string('url', 500)->nullable();
            $table->string('image')->nullable();
            $table->string('image_mobile')->nullable();
            $table->boolean('active');
            $table->integer('sort');
            $table->string('slogan', 400)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
