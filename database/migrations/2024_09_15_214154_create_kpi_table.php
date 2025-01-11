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
        Schema::create('kpi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('goal_id')->nullable();
            $table->foreignId('priority_area_id')->nullable();
            $table->foreignId('aspiration_id')->nullable();
            $table->foreignId('target_id')->nullable();
            $table->text('type')->nullable();
            $table->text('name');
            $table->text('kpi_definition');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpi');
    }
};