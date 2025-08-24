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
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('source'); // smoobu, manual, etc.
            $table->string('event_type'); // booking.created, booking.updated, stay.ended, etc.
            $table->string('external_id')->nullable(); // ID from external system
            $table->json('headers')->nullable();
            $table->json('payload');
            $table->string('status')->default('received'); // received, processed, failed
            $table->text('error_message')->nullable();
            $table->datetime('processed_at')->nullable();
            $table->timestamps();
            
            $table->index(['source', 'event_type']);
            $table->index(['external_id', 'source']);
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhook_logs');
    }
};
