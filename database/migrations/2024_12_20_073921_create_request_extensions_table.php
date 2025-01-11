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
        Schema::create('request_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('project_id')->nullable();
            $table->foreignId('outcome_proposal_id')->nullable();
            $table->foreignId('output_proposal_id')->nullable();
            $table->foreignId('activity_proposal_id')->nullable();
            $table->string('extension_type');
            $table->string('extended_type')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->text('remark')->nullable();
            $table->text('supporting_document')->nullable();
            $table->decimal('new_requested_amount', 50, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_extensions');
    }
};
