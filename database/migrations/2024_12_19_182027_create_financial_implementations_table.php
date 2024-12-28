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
        Schema::create('financial_implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('concept_note_id');
            $table->foreignId('outcome_proposal_id');
            $table->foreignId('output_proposal_id');
            $table->foreignId('activity_proposal_id');
            $table->decimal('requested_amount', 50, 2);
            $table->string('percent_requested');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_implementations');
    }
};
