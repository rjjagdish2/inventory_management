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
        Schema::create('inward_items', function (Blueprint $table) {
            $table->id();

            // Foreign key columns
            $table->unsignedBigInteger('inward_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            // Item details
            $table->decimal('tare_weight', 10, 2)->nullable();
            $table->decimal('gross_weight', 10, 2)->nullable();
            $table->decimal('net_weight', 10, 2)->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('inward_id')->references('id')->on('inwards')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('product_profile')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inward_items');
    }
};
