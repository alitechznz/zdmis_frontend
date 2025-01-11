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
        Schema::create('project_proposal_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_proposal_output_id');
            $table->foreignId('priority_area_id');
            $table->foreignId('indicator_id');
            $table->foreignId('created_by');
            $table->text('indicator_name');
            $table->text('kpi_definition');
            $table->text('baseline_value');
            $table->text('baseline_unit');
            $table->text('target_value');
            $table->text('target_unit');
            $table->text('means_verification')->nullable();
            $table->text('assumption_risk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_proposal_indicators');
    }
};
