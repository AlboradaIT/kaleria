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
        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('apartment_id')->constrained()->onDelete('cascade');
            $table->string('external_id')->unique()->nullable(); // External stay ID if different from booking
            $table->date('start_date');
            $table->date('end_date');
            $table->datetime('actual_check_in')->nullable();
            $table->datetime('actual_check_out')->nullable();
            $table->integer('guests_count');
            $table->string('status')->default('upcoming'); // upcoming, active, completed, cancelled
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['apartment_id', 'start_date', 'end_date']);
            $table->index(['status', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays');
    }
};
