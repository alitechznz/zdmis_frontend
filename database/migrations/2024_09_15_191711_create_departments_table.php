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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->nullable();
            $table->foreignId('ministry_id')->nullable();
            $table->foreignId('created_by');
            $table->text('name');
            $table->text('address')->nullable();
            $table->text('web_url')->nullable();
            $table->text('vote_number')->nullable();
            $table->text('under')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
