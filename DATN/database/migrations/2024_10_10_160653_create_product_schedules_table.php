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
        Schema::create('product_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('description', 1000)->nullable();
            $table->integer('product_category_id');
            $table->boolean('active');
            $table->integer('price1')->nullable();
            $table->integer('price2')->nullable();
            $table->integer('price3')->nullable();
            $table->integer('price4')->nullable();
            $table->integer('price5')->nullable(); 
            $table->integer('original_price')->nullable();
            $table->integer('dat_coc');
            $table->string('do_tuoi_tre_em', 50)->nullable();
            $table->string('do_tuoi_tre_nho', 50)->nullable();
            $table->string('do_tuoi_em_be', 50)->nullable();
            $table->string('tieu_de_phu_thu', 50)->nullable();
            $table->string('product_code', 50)->nullable();
            $table->string('time', 50);
            $table->text('gift')->nullable();
            $table->text('gift_note')->nullable();
            $table->integer('slot');
            $table->string('url', 500)->nullable();
            $table->string('url_book_tour', 500)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_schedules');
    }
};
