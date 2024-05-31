
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User; // Adjust the namespace based on your actual User model location

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('num_room');
            $table->string('room_type')->nullable();
            $table->string('ac_non_ac')->nullable();
            $table->string('food')->nullable();
            $table->string('bed_count')->nullable();
            $table->string('rent')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fileupload')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
