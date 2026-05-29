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
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('selling_price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->string('category')->default('General');
            $table->string('size')->nullable(); // For clothing: S, M, L, XL
            $table->string('color')->nullable(); // For clothing colors
            $table->string('sku')->unique()->nullable(); // Stock keeping unit
            $table->string('image')->nullable(); // Image path
            $table->boolean('is_active')->default(true);
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
