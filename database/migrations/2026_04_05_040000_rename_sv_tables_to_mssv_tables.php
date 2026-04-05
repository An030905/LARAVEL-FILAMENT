<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('sv23810310263_products')) {
            Schema::table('sv23810310263_products', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }

        if (Schema::hasTable('sv23810310263_categories') && ! Schema::hasTable('23810310263_categories')) {
            Schema::rename('sv23810310263_categories', '23810310263_categories');
        }

        if (Schema::hasTable('sv23810310263_products') && ! Schema::hasTable('23810310263_products')) {
            Schema::rename('sv23810310263_products', '23810310263_products');
        }

        if (Schema::hasTable('23810310263_products') && Schema::hasTable('23810310263_categories')) {
            Schema::table('23810310263_products', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('23810310263_categories')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('23810310263_products')) {
            Schema::table('23810310263_products', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
        }

        if (Schema::hasTable('23810310263_products') && ! Schema::hasTable('sv23810310263_products')) {
            Schema::rename('23810310263_products', 'sv23810310263_products');
        }

        if (Schema::hasTable('23810310263_categories') && ! Schema::hasTable('sv23810310263_categories')) {
            Schema::rename('23810310263_categories', 'sv23810310263_categories');
        }

        if (Schema::hasTable('sv23810310263_products') && Schema::hasTable('sv23810310263_categories')) {
            Schema::table('sv23810310263_products', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('sv23810310263_categories')->cascadeOnDelete();
            });
        }
    }
};
