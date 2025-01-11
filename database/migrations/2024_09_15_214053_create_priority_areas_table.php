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
        Schema::create('priority_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('pillar_id')->constrained();
            $table->foreignId('goal_id')->nullable();
            $table->text('type')->nullable();
            $table->text('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priority_areas');
    }
};
