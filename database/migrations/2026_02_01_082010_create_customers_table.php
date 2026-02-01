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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            // Extended profile fields (nullable for later completion)
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->string('qualification')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->text('bio')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('avatar')->nullable();
            $table->json('interests')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
