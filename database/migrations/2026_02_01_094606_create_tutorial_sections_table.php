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
        Schema::create('tutorial_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // e.g., "Introduction to Azure Virtual Machines"
            $table->string('slug'); // e.g., "introduction"
            $table->integer('order')->default(0); // For ordering sections
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['service_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorial_sections');
    }
};
