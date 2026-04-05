<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('23810310263_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('23810310263_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('23810310263_categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->string('image_path')->nullable();
            $table->enum('status', ['draft', 'published', 'out_of_stock'])->default('draft');
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('23810310263_products');
        Schema::dropIfExists('23810310263_categories');
    }
};

