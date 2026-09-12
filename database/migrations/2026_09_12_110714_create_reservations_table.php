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
        Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        // These create the Foreign Keys linking to users and desks
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('desk_id')->constrained()->cascadeOnDelete();
        
        $table->date('date');
        $table->string('status')->default('confirmed');
        $table->timestamps();

        // Smart constraint: Prevents booking the same desk on the same day!
        $table->unique(['desk_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
