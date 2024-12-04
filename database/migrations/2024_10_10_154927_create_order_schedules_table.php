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
        Schema::create('order_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('order_code');
            $table->boolean('payment'); 
            $table->integer('type_pay');
            $table->decimal('dat_coc', 18, 2);
            $table->dateTime('transport_date');
            $table->integer('quantity1');
            $table->integer('price1')->nullable();
            $table->integer('quantity2');
            $table->integer('price2')->nullable();
            $table->integer('quantity3');
            $table->integer('price3')->nullable();
            $table->integer('quantity4');
            $table->integer('price4')->nullable();
            $table->integer('quantity5');
            $table->integer('price5')->nullable();
            $table->integer('product_schedule_id')->nullable(); 
            $table->integer('product_id')->nullable(); 
            $table->integer('status');
            $table->text('body')->nullable(); 
            $table->text('discount_code')->nullable();
            $table->string('customer_info_full_name', 50);
            $table->string('customer_info_address', 200)->nullable();
            $table->string('customer_info_email', 50)->nullable();
            $table->string('customer_info_body', 50)->nullable();
            $table->string('customer_info_phone', 50)->nullable();
            $table->text('vehicle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_schedules');
    }
};
