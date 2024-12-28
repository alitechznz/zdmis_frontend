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
        Schema::create('add_lga_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->foreignId('sector_id');
            $table->foreignId('district_id');
            $table->foreignId('shehia_id');
            $table->foreignId('identified_by');
            $table->text('title');
            $table->date('date_identified');
            $table->text('priority_level');
            $table->text('status');
            $table->text('attachment');
            $table->text('potential_solution');
            $table->text('resource_needed');
            $table->text('community_feedback');
            $table->text('expected_outcome');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_lga_challenges');
    }
};
