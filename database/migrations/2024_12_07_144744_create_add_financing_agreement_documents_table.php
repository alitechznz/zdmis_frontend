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
        Schema::create('add_financing_agreement_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');
            $table->foreignId('financing_agreement_id');
            $table->text('attachment_title');
            $table->text('attachment');
            $table->string('status')->default('allowed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_financing_agreement_documents');
    }
};