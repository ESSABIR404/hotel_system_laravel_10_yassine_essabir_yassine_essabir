<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Check if the column exists before adding it
            if (!Schema::hasColumn('rooms', 'id_users')) {
                // Add the foreign key column
                $table->unsignedBigInteger('id_users')->nullable();

                // Define the foreign key constraint
                $table->foreign('id_users')->references('id')->on('users');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Remove the foreign key column
            $table->dropForeign(['id_users']);
            $table->dropColumn('id_users');
        });
    }
}

