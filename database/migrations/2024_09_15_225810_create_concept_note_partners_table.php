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
        Schema::create('concept_note_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('concept_note_id');
            $table->text('name');
            $table->text('short_name');
            $table->text('type');
            $table->text('contact');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('detail');
            $table->date('create_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_partners');
    }
};
