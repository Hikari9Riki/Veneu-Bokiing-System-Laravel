<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // 5. Create Venue Table
        Schema::create('venues', function (Blueprint $table) {
            $table->string('venueID', 50)->primary();
            $table->string('name', 100);
            $table->string('location', 255)->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });

        // 6. Create Reservation Table
        Schema::create('reservations', function (Blueprint $table) {
            // 1. The Reservation's own unique ID
            $table->string('reservationID', 50)->primary();
            
            $table->date('date');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('status', 20)->default('Pending');
            
            // 2. Define the columns for Foreign Keys
            $table->string('venueID', 50)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // CHANGED: Renamed to user_id

            // 3. Set up the constraints
            $table->foreign('venueID')->references('venueID')->on('venues')->onDelete('cascade');
            
            // CHANGED: Link 'user_id' column to 'id' on 'users' table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Drop in reverse order to avoid Foreign Key errors
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('students');
        Schema::dropIfExists('users');
    }
};
