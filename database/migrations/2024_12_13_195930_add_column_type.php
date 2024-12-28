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
        Schema::table('concept_notes', function (Blueprint $table) {
            $table->string('type')->nullable();
        });
        Schema::table('concept_note_explanations', function (Blueprint $table) {
            $table->string('type')->nullable();
        });
        Schema::table('concept_note_program_projects', function (Blueprint $table) {
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concept_note', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('concept_note_explanations', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::table('concept_note_program_projects', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
