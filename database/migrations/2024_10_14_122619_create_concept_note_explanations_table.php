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
        Schema::create('concept_note_explanations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');
            $table->text('background');
            $table->text('justification');
            $table->text('objective');
            $table->text('outcome');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_explanations');
    }
};
