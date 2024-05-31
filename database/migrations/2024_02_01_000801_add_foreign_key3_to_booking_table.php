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
        Schema::table('booking', function (Blueprint $table) {
            //
            
            if (!Schema::hasColumn('bookings', 'id_customers')) {
                // Add the foreign key column
                $table->unsignedBigInteger('id_customers')->nullable();

                // Define the foreign key constraint
                $table->foreign('id_customers')->references('id')->on('customers');
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
               
                $table->dropForeign(['id_customers']);
                $table->dropColumn('id_customers');
               
            });
        });
        
    }
};
