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
        Schema::create('add_financing_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concept_note_id');
            $table->text('agreement_title');
            $table->text('agreement_reference');
            $table->text('funding_agency');
            $table->bigInteger('total_funding_amount');
            $table->string('currency');
            $table->date('terms_agreement_start_date');
            $table->date('terms_agreement_end_date');
            $table->text('conditions_precedent');
            $table->text('repayment_terms')->nullable();
            $table->decimal('interest_rate')->nullable();
            $table->text('termination_clause')->nullable();
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_financing_agreements');
    }
};
