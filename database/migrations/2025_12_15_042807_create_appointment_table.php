<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('pet_id')->constrained('pets')->cascadeOnDelete();
            $table->string('pet_name');
            $table->string('breed')->nullable();

            $table->foreignId('groomer_id')->nullable()->constrained('groomers')->cascadeOnDelete();
            
            // ✅ Correct foreign key definition
            $table->foreignId('service_id')->nullable()
                ->constrained('services')
                ->nullOnDelete();

            $table->dateTime('scheduled_at');
            $table->enum('status', [
                'pending',
                'confirmed',
                'in_progress',
                'completed',
                'no_show',
                'cancelled'
            ])->default('pending');
            $table->text('client_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('appointment');
    }
};