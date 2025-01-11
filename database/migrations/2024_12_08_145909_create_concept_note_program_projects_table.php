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
        Schema::create('concept_note_program_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');
            $table->foreignId('plan_id');
            $table->foreignId('strategic_area_id');
            $table->foreignId('priority_area_id');
            $table->foreignId('created_by');
            $table->text('project_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_program_projects');
    }
};
