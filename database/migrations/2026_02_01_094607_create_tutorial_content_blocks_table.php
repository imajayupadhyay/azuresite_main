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
        Schema::create('tutorial_content_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutorial_section_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['content', 'code', 'tip', 'warning', 'info']); // Block type
            $table->longText('content'); // Main content (HTML for content type, code for code type, etc.)
            $table->string('code_language')->nullable(); // For code blocks: bash, php, javascript, etc.
            $table->integer('order')->default(0); // Order within section
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['tutorial_section_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorial_content_blocks');
    }
};
