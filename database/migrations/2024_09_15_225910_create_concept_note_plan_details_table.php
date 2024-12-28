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
        Schema::create('concept_note_plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id'); 
            $table->text('project_detail_type');
            $table->text('project_detail'); 
            $table->text('detail_status');
            $table->date('detail_create_at');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_plan_details');
    }
};