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
        Schema::table('project_proposal_outcomes', function (Blueprint $table) {
            $table->foreignId('concept_note_id')->nullable();
        });
        Schema::table('project_proposal_outputs', function (Blueprint $table) {
            $table->foreignId('concept_note_id')->nullable();
        });
        Schema::table('project_proposal_activities', function (Blueprint $table) {
            $table->foreignId('concept_note_id')->nullable();
        });
        Schema::table('project_proposal_indicators', function (Blueprint $table) {
            $table->foreignId('concept_note_id')->nullable();
        });
        Schema::table('project_proposal_attachments', function (Blueprint $table) {
            $table->foreignId('concept_note_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_proposal_outcomes', function (Blueprint $table) {
            $table->dropColumn('concept_note_id');
        });
        Schema::table('project_proposal_outputs', function (Blueprint $table) {
            $table->dropColumn('concept_note_id');
        });
        Schema::table('project_proposal_activities', function (Blueprint $table) {
            $table->dropColumn('concept_note_id');
        });
        Schema::table('project_proposal_indicators', function (Blueprint $table) {
            $table->dropColumn('concept_note_id');
        });
        Schema::table('project_proposal_attachments', function (Blueprint $table) {
            $table->dropColumn('concept_note_id');
        });
    }
};
