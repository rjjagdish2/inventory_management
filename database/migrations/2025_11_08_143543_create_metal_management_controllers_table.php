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
        Schema::dropIfExists('metals');
        Schema::create('metals', function (Blueprint $table) {
            $table->id();
            $table->string('name',191)->nullable();
            $table->timestamps();
        });

        Schema::table('grades', function (Blueprint $table) {

            $table->unsignedBigInteger('metal_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['metal_id']);
            $table->dropColumn('metal_id');
        });
        Schema::dropIfExists('metals');
    }
};
