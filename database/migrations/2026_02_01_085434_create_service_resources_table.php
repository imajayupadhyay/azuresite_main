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
        Schema::create('service_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->enum('type', ['tutorial', 'documentation', 'video', 'quickstart'])->default('tutorial');
            $table->json('content')->nullable(); // Stores sections array
            $table->string('code_language')->nullable();
            $table->text('code_snippet')->nullable();
            $table->text('tip')->nullable();
            $table->text('warning')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['service_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_resources');
    }
};
