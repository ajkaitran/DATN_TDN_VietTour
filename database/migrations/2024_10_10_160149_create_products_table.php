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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 1000);
            $table->text('image')->nullable(); 
            $table->integer('star');
            $table->text('body')->nullable();
            $table->integer('product_category_id');
            $table->integer('price')->nullable();
            $table->integer('sale_off')->nullable();
            $table->string('product_code', 50)->nullable();
            $table->boolean('hot');
            $table->boolean('active');
            $table->string('pay_url', 500)->nullable();
            $table->string('url', 500)->nullable();
            $table->integer('view');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
