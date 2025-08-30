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
        Schema::table('product_profile', function (Blueprint $table) {
            if (Schema::hasColumn('product_profile', 'grade')) {
                $table->dropColumn('grade');
            }
            $table->unsignedBigInteger('grade')->nullable()->after('id');

            // Add foreign key constraint
            $table->foreign('grade')
                  ->references('id')
                  ->on('grades')
                  ->onDelete('set null'); // you can change to cascade if required
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_profile', function (Blueprint $table) {
            $table->dropForeign(['grade']);
            $table->dropColumn('grade');
        });
    }
};
