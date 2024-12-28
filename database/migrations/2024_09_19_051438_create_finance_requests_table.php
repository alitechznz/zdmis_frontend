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
        Schema::create('finance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectactivity_id');
            $table->bigInteger('amount');
            $table->string('currency');
            $table->foreignId('request_id');
            $table->foreignId('attachment');
            $table->string('status');
            $table->date('requested_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_requests');
    }
};
