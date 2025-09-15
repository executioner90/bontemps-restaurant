<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations_meals', function (Blueprint $table) {
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->foreignId('meal_id')->constrained('meals');
        });
    }

    public function down(): void
    {
        schema::dropIfExists('reservations_meals');
    }
};
