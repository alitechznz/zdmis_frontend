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
        Schema::create('monitoring_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('indicator_category');
            $table->foreignId('kpi_id');
            $table->foreignId('baseline_id');
            $table->foreignId('target_id');
            $table->foreignId('responsible_institution_id');
            $table->foreignId('project_proposal_id');
            $table->text('data_source');
            $table->text('frequency');
            $table->text('proposal_code');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_evaluations');
    }
};
