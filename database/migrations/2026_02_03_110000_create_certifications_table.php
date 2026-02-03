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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_category_id')->constrained()->cascadeOnDelete();
            $table->string('code')->unique(); // e.g., AZ-900, AZ-104
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('long_description')->nullable();

            // Level color for UI theming (green, blue, purple, orange)
            $table->string('level_color')->default('blue');

            // Exam details
            $table->string('exam_duration')->nullable(); // e.g., "60 minutes"
            $table->string('questions')->nullable(); // e.g., "40-60"
            $table->string('passing_score')->nullable(); // e.g., "700/1000"
            $table->string('exam_cost')->nullable(); // e.g., "$165 USD"
            $table->string('duration')->nullable(); // Prep time e.g., "1-2 months"
            $table->string('last_updated')->nullable(); // e.g., "January 2024"

            // JSON fields for complex data
            $table->json('prerequisites')->nullable(); // Array of prerequisite strings
            $table->json('target_audience')->nullable(); // Array of target audience strings
            $table->json('modules')->nullable(); // Array of {number, title, duration, lessons[]}
            $table->json('skills')->nullable(); // Array of {name, weight, topics[]}
            $table->json('resources')->nullable(); // Array of {icon, title, description, url}
            $table->json('faqs')->nullable(); // Array of {question, answer}

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
