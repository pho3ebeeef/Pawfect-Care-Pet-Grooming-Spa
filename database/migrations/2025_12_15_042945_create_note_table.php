<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            // Allow multiple notes per appointment
            $table->foreignId('appointment_id')
                ->constrained('appointments')
                ->cascadeOnDelete();

            $table->foreignId('groomer_id')
                ->constrained('groomers')
                ->cascadeOnDelete();

            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void {
    Schema::dropIfExists('notes');
    }
};