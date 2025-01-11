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
        Schema::create('project_proposal_activities', function (Blueprint $table) {
            $table->id();
            $table->text('activity_name');
            $table->text('activity_reason');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('planning_amount');
            $table->string('currency');
            $table->foreignId('project_proposal_output_id');
            $table->foreignId('source_financing_id');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_proposal_activities');
    }
};
