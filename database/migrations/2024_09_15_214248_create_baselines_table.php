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
        Schema::create('baselines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('kpi_id');
            $table->foreignId('unit_id');
            $table->text('name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('value');
            $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baselines');
    }
};