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
        Schema::create('concept_note_finance_arrangement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');  // Assuming you'll link this to a 'projects' table
            $table->text('financing_modality');
            $table->text('gfs_code');
            $table->bigInteger('total_project_cost');
            $table->text('tentative_financing_arrangement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_finance_arrangement');
    }
};
