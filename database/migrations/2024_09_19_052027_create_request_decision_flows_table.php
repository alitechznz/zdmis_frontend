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
        Schema::create('request_decision_flows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financerequest_id');
            $table->string('status');
            $table->text('comment');
            $table->text('action');
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
        Schema::dropIfExists('request_decision_flows');
    }
};
