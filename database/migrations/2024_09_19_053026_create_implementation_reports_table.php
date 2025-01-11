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
        Schema::create('implementation_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectactivity_id');
            $table->foreignId('indicator_id');
            $table->foreignId('baseline_id');
            $table->text('result_value');
            $table->text('result_value_percentage');
            $table->text('remark');
            $table->string('status');
            $table->foreignId('createdby');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementation_reports');
    }
};
