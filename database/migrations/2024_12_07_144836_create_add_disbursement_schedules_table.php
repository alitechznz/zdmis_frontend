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
        Schema::create('add_disbursement_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');
            $table->foreignId('financing_agreement_id');
            $table->string('milestone_type');
            $table->date('schedule_date')->nullable();
            $table->text('condition')->nullable();
            $table->string('installment_type')->nullable();
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_disbursement_schedules');
    }
};
