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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); 
            $table->string('city', 50)->nullable();
            $table->string('image', 500)->nullable();
            $table->string('cover_image', 500)->nullable(); 
            $table->string('url', 500)->nullable(); 
            $table->integer('sort'); 
            $table->boolean('active'); 
            $table->boolean('hot'); 
            $table->boolean('home_page')->default(0);
            $table->integer('parent_id')->nullable(); 
            $table->string('hotline', 50)->nullable(); 
            $table->text('body')->nullable(); 
            $table->integer('type');
            $table->string('temp_city', 50)->nullable(); 
            $table->dateTime('time_get_temp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
