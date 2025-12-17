<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // IMPORTANT: SQLite-safe guard
        if (Schema::hasColumn('appointments', 'species')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('species');
            });
        }
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('species')->nullable();
        });
    }
};
