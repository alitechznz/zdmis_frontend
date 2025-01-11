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
        Schema::create('addlga_approve_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('concept_note_id');
            $table->foreignId('source_of_fund_id');
            $table->string('location_level');
            $table->bigInteger('project_cost');
            $table->string('start_time_period');
            $table->string('end_time_period');
            $table->string('implementation_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addlga_approve_lists');
    }
};
