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
        Schema::create('homework_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->nullable()->constrained('lectures');
            $table->string('name');
            $table->string('description');
            $table->string('file')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homework_tasks');
    }
};
