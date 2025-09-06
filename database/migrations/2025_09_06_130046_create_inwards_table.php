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
        Schema::create('inwards', function (Blueprint $table) {
            $table->id();
            $table->string('grn_no')->unique();       // GRN number
            $table->unsignedBigInteger('order_id')->nullable();   // Reference to order
            $table->unsignedBigInteger('supervisor_id')->nullable(); // Reference to supervisor
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('supervisor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inwards');
    }
};
