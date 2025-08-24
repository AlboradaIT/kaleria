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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->onDelete('cascade');
            $table->string('external_id')->unique()->nullable(); // Smoobu booking ID
            $table->string('guest_name');
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('guests_count');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('status')->default('confirmed'); // confirmed, cancelled, etc.
            $table->json('metadata')->nullable(); // Additional booking data
            $table->timestamps();
            
            $table->index(['apartment_id', 'check_in_date', 'check_out_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
