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
            $table->string('category')->nullable()->after('name');
        });
        Schema::table('priority_areas', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
        Schema::table('aspirations', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
        Schema::table('kpi', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
        Schema::table('baselines', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
        Schema::table('targets', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pillars', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('priority_areas', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('kpi', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('targets', function (Blueprint $table) {
            $table->dropColumn('category');
        });
        Schema::table('baselines', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
