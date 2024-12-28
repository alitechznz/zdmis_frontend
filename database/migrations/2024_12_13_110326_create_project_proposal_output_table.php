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
        Schema::create('project_proposal_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_proposal_outcome_id');
            $table->text('output');
            $table->text('reporting_period');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_proposal_output');
    }
};
