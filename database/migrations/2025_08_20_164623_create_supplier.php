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
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('phone')->nullable();
            $table->timestamps();
        });
        Schema::create('product_profile', function (Blueprint $table) {
            $table->id();
            $table->text('item_code')->nullable();
            $table->text('name')->nullable();
            $table->decimal('size',10,2)->nullable();
            $table->text('grade')->nullable();
            $table->text('castig_ratio')->nullable();
            $table->text('design')->nullable();
            $table->timestamps();
        });
        Schema::create('supervisor', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('product_profile');
        Schema::dropIfExists('supervisor');
    }
};
