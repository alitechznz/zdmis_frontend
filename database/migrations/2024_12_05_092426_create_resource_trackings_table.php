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
        Schema::create('resource_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finance_particular_id');
            $table->foreignId('source_financing_id');
            $table->foreignId('project_id');
            $table->text('period');
            $table->string('currency_unit');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_trackings');
    }
};
