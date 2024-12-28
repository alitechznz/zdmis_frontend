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
        Schema::table('project_questions', function (Blueprint $table) {
            //$table->string('sub_section')->nullable(); // Add your first column
            //$table->integer('score_weight')->default(0); // Add your second column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_questions', function (Blueprint $table) {
            //
        });
    }
};
