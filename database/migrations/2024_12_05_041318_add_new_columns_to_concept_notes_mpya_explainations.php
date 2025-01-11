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
        Schema::table('concept_note_explanations', function (Blueprint $table) {
            $table->longText('overall_approach')->nullable()->after('outcome');
            $table->longText('outputs')->nullable()->after('outcome');
            $table->longText('inputs')->nullable()->after('outcome');
            $table->longText('timeframeResponsibility')->nullable()->after('outcome');
            $table->longText('sustainabilityRisk')->nullable()->after('outcome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concept_note_explainations', function (Blueprint $table) {
            //
        });
    }
};
