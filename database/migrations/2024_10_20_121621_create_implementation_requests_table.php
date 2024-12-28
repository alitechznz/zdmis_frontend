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
        Schema::create('implementation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by');
            $table->text('contract')->nullable();
            $table->text('invoice')->nullable();
            $table->text('latter')->nullable();
            $table->text('attachment')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementation_requests');
    }
};
