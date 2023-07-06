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
        Schema::create('user_homework_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homework_task_id')->nullable()->constrained('homework_tasks'); // one to many
            $table->foreignId('user_id')->nullable()->constrained('users'); // one to one
            $table->string('description')->nullable();
            $table->string('student_homework')->nullable();
            $table->boolean('on_time')->default(false);
            $table->boolean('is_working')->default(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_homework_tasks');
    }
};
