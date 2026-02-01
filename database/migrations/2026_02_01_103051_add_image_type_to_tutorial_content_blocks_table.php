<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, modify the enum to include 'image'
        DB::statement("ALTER TABLE tutorial_content_blocks MODIFY COLUMN type ENUM('content', 'code', 'tip', 'warning', 'info', 'image')");

        // Add image-related columns
        Schema::table('tutorial_content_blocks', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('code_language');
            $table->string('image_alt')->nullable()->after('image_path');
            $table->string('image_caption')->nullable()->after('image_alt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove image columns
        Schema::table('tutorial_content_blocks', function (Blueprint $table) {
            $table->dropColumn(['image_path', 'image_alt', 'image_caption']);
        });

        // Revert enum to original values
        DB::statement("ALTER TABLE tutorial_content_blocks MODIFY COLUMN type ENUM('content', 'code', 'tip', 'warning', 'info')");
    }
};
