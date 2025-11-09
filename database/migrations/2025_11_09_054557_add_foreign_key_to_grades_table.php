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
        DB::statement('ALTER TABLE product_profile DROP FOREIGN KEY product_profile_grade_foreign;');

        Schema::dropIfExists('grades');
        Schema::dropIfExists('metals');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
                $table->id();
                $table->foreignId('metal_id')->constrained('metals')->onDelete('cascade');
                $table->string('name');
                $table->timestamps();
        });
    }
};
