<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concept_notes', function (Blueprint $table) {
            $table->id();
            $table->text('selected_plans')->nullable();
            $table->foreignId('createdby');
            $table->text('projectname')->nullable();
            $table->text('shortname')->nullable();
            $table->foreignId('sector_id');
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->text('description')->nullable();
            $table->integer('process_status')->nullable();
            $table->timestamps();
            // $table->decimal('totalbudget', 15, 2);
            // $table->string('currency_unit');
            // $table->foreignId('area_id');
            // $table->integer('area_level');
            // $table->string('mainsector');
            // $table->foreignId('responsible_org_id');
            // $table->string('responsible_org_type');
            // $table->foreignId('responsible_user_id');
            // $table->integer('data_status');
            // $table->string('project_type');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concept_notes');
    }
};
