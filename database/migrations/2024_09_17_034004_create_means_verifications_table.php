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
        Schema::create('means_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectproposal_id');
            $table->text('source');
            $table->text('source_type');
            $table->text('how_data_obtained');
            $table->text('where_data_obtained');
            $table->string('status');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('means_verifications');
    }
};
