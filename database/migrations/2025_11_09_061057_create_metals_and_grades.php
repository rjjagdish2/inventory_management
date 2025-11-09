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
        Schema::create('metals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metal_id')
                ->constrained('metals')
                ->onDelete('cascade'); // when metal is deleted, its grades are deleted too
            $table->string('name')->nullable(); // e.g., SS304, C11000, Al6061
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
        Schema::dropIfExists('metals');
    }
};
