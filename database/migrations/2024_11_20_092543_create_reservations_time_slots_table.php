<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('reservations_time_slots', function (Blueprint $table) {
            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->onDelete('cascade');
            $table->foreignId('time_slot_id')
                ->constrained('time_slots')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations_time_slots');
    }
};
