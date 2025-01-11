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
        Schema::create('resource_tracking_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
//            $table->foreignId('project_info_id');
            $table->foreignId('source_finance_id');
            $table->string('finance_particular');
            $table->decimal('amount', 50, 2);
            $table->text('attachment')->nullable();
            $table->text('report_period');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_tracking_reports');
    }
};
