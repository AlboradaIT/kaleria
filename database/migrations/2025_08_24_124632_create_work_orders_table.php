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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->onDelete('cascade');
            $table->foreignId('stay_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->datetime('scheduled_start');
            $table->datetime('scheduled_end');
            $table->datetime('actual_start')->nullable();
            $table->datetime('actual_end')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('pending'); // pending, assigned, accepted, rejected, in_progress, completed, cancelled
            $table->text('worker_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['apartment_id', 'scheduled_start']);
            $table->index(['assigned_to', 'status']);
            $table->index(['status', 'scheduled_start']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
