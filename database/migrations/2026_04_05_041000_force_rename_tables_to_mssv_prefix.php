<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('23810310263_categories') && Schema::hasTable('23810310263_products') && ! Schema::hasTable('sv23810310263_categories') && ! Schema::hasTable('sv23810310263_products')) {
            return;
        }

        if (Schema::hasTable('sv23810310263_products') && Schema::hasTable('sv23810310263_categories')) {
            DB::statement('ALTER TABLE `sv23810310263_products` DROP FOREIGN KEY `sv23810310263_products_category_id_foreign`');
        }

        if (Schema::hasTable('sv23810310263_categories') && ! Schema::hasTable('23810310263_categories')) {
            DB::statement('RENAME TABLE `sv23810310263_categories` TO `23810310263_categories`');
        }

        if (Schema::hasTable('sv23810310263_products') && ! Schema::hasTable('23810310263_products')) {
            DB::statement('RENAME TABLE `sv23810310263_products` TO `23810310263_products`');
        }

        $foreignKeyExists = DB::selectOne("SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '23810310263_products' AND CONSTRAINT_TYPE = 'FOREIGN KEY' AND CONSTRAINT_NAME = '23810310263_products_category_id_foreign'");

        if (Schema::hasTable('23810310263_products') && Schema::hasTable('23810310263_categories') && ! $foreignKeyExists) {
            DB::statement('ALTER TABLE `23810310263_products` ADD CONSTRAINT `23810310263_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `23810310263_categories` (`id`) ON DELETE CASCADE');
        }
    }

    public function down(): void
    {
        // No-op rollback for this normalization migration.
    }
};
