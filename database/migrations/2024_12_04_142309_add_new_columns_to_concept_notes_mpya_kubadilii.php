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
        Schema::table('concept_notes', function (Blueprint $table) {
            $table->foreignId('contribution_sector');
            $table->foreignId('organization_name');
            $table->foreignId('responsible_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concept_notes', function (Blueprint $table) {
            //
        });
    }
};