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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();;
            $table->string('password');
            $table->string('user_type')->default('public');
            $table->string('organization')->nullable();
            $table->string('avatar')->default('default_profile.png');
            $table->string('user_cv')->nullable();
            $table->string('phone')->nullable();
            $table->text('info')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
