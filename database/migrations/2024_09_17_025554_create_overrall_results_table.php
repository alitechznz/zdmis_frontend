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
        Schema::create('overrall_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screening_id');
            $table->text('result');
            $table->text('comment');
            $table->string('created_by');
            $table->string('status');
            $table->string('condition')->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overrall_results');
    }
};
