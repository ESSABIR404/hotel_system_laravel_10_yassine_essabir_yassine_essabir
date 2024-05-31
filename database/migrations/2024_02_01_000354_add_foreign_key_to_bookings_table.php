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
        Schema::table('bookings', function (Blueprint $table) {
            // Check if the column exists before adding it
            if (!Schema::hasColumn('bookings', 'id_users')) {
                // Add the foreign key column
                $table->unsignedBigInteger('id_users')->nullable();

                // Define the foreign key constraint
                $table->foreign('id_users')->references('id')->on('users');
            }
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            Schema::table('bookings', function (Blueprint $table) {
                // Remove the foreign key column
                $table->dropForeign(['id_users']);
                $table->dropColumn('id_users');
               
            });
        });
    }
};
