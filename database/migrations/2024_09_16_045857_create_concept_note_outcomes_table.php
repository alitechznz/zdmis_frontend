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
        Schema::create('concept_note_outcomes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignId('conceptnote_id');
            // $table->foreignId('createdby');

            // $table->text('details');
            // $table->decimal('value', 15, 2);
            // $table->string('value_unit');
            // $table->year('value_year');
            // $table->string('status');
            // $table->string('timeline');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_outcomes');
    }
};
