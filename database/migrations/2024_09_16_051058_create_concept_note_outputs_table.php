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
        Schema::create('concept_note_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conceptnote_id');
            $table->foreignId('outcome_id');
            $table->text('name');
            $table->text('output_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_outputs');
    }
};
