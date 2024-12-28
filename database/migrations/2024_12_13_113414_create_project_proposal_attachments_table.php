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
        Schema::dropIfExists('project_proposal_attachments');
        Schema::create('project_proposal_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('concept_note_id');
            $table->string('attachment_name');
            $table->string('type');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_proposal_attachments');
    }
};
