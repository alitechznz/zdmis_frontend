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
        Schema::table('pillars', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
        Schema::table('priority_areas', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
        Schema::table('aspirations', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
        Schema::table('kpi', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
        Schema::table('baselines', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
        Schema::table('targets', function (Blueprint $table) {
            $table->foreignId('link_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pillars', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
        Schema::table('priority_areas', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
        Schema::table('kpi', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
        Schema::table('targets', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
        Schema::table('baselines', function (Blueprint $table) {
            $table->dropColumn('link_id');
        });
    }
};
