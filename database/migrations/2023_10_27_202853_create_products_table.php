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
            $table->string('description');
            $table->integer('price');
            $table->foreignId('category')->nullable();
            $table->foreignId('product_type')->nullable();
            $table->integer('quantity');
            $table->string('img')->nullable();
            $table->timestamps();
            $table->foreign('category')->references('id')->on('product_categories')
            ->nullOnDelete()->cascadeOnUpdate();
            $table->foreign('product_type')->references('id')->on('product_types')
            ->nullOnDelete()->cascadeOnUpdate();
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
