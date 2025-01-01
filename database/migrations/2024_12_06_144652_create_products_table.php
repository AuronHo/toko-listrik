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
            $table->string('name')->required();
            $table->string('slug')->unique();
            $table->foreignId('currency_id')->constrained(
                table: 'currencies', 
                indexName: 'products_currency_id'
            );
            $table->integer('price');
            $table->foreignId('discount_id')->constrained(
                table: 'discounts', 
                indexName: 'products_discount_id'
            );
            $table->integer('stock');
            $table->string('status');
            $table->foreignId('category_id')->constrained(
                table: 'categories', 
                indexName: 'products_category_id'
            );
            $table->string('image')->nullable();
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
