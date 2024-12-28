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
        Schema::create('implementation_decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('implementationreport_id');
            $table->string('officer_status');
            $table->text('comment');
            $table->text('action');
            $table->string('decision_status');
            $table->date('date_created');
            $table->foreignId('role_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementation_decisions');
    }
};
