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
        Schema::table('financial_implementations', function (Blueprint $table) {
            $table->string('report_type')->nullable();
            $table->decimal('total_disburesement', 50, 2);
            $table->decimal('remained_amount', 50, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_implementations', function (Blueprint $table) {
            //
        });
    }
};
