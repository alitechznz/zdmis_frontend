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
        Schema::create('concept_note_financings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('note_financing_id');
            $table->foreignId('type_finance_id');
            $table->foreignId('sponsor_id');
            $table->foreignId('currency_id');
            $table->bigInteger('total_amount');
            $table->bigInteger('compensation_cost');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('status');
            $table->text('agreement_doc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concept_note_financings');
    }
};
