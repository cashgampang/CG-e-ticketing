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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['IT', 'user'])->default('user')->after('email');
        });
        
        // Migration 1: Tabel teams
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Nama IT programmer
            $table->timestamps();
        });

        // Migration 2: Tabel tickets
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code', 6)->unique(); // 6 karakter angka+huruf kapital random
            $table->string('requester_name', 100); // Nama yang mengajukan
            $table->text('problem_detail'); // Detail masalah
            $table->text('definition_of_done'); // DoD
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->foreignId('assigned_to')->nullable()->constrained('teams')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang membuat ticket
            $table->enum('role', ['IT', 'user'])->default('user'); // Role user
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            // Index untuk performa
            $table->index('ticket_code');
            $table->index('status');
            $table->index('assigned_to');
            $table->index('user_id');
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('teams');
    }
};
