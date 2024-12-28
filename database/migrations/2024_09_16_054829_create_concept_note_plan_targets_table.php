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
        Schema::create('concept_note_plan_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_plan_baseline_id');
            $table->string('status');
            $table->integer('value');
            $table->integer('unit');
            $table->integer('year');
            $table->foreignId('created_by');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_plan_targets');
    }
};
