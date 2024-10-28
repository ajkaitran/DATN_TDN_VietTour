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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 100);
            $table->string('description', 500);
            $table->boolean('active');
            $table->integer('article_category_id');
            $table->string('image')->nullable();
            $table->text('body')->nullable();
            $table->integer('view');
            $table->boolean('hot');
            $table->string('url', 300)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
