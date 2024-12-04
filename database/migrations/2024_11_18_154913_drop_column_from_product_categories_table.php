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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('cover_image');
            $table->dropColumn('temp_city');
            $table->dropColumn('body');
            $table->dropColumn('sort');
            $table->dropColumn('time_get_temp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('cover_image', 500)->nullable()->after('image');
            $table->string('temp_city', 50)->nullable()->after('type');
            $table->text('body')->nullable()->after('meta_description');
            $table->integer('sort')->nullable()->after('url');
            $table->string('time_get_temp', 50)->nullable()->after('type');
        });
    }
};
