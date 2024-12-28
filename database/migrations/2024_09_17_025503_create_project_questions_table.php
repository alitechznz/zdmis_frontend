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
        Schema::create('project_questions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('page');
            $table->text('section');
            $table->text('number');
            $table->text('result')->nullable();
            $table->text('section_number');
            $table->text('sub_section');
            $table->integer('score_weight');
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_questions');
    }
};
