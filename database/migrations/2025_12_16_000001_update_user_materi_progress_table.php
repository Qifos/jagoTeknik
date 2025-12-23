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
        // Check if table exists and add columns if not present
        Schema::table('user_materi_progress', function (Blueprint $table) {
            // Add material reading status column if not exists
            if (!Schema::hasColumn('user_materi_progress', 'content_scrolled_to_bottom')) {
                $table->boolean('content_scrolled_to_bottom')->default(false)->after('content_read');
            }

            // Add video watching completion column if not exists
            if (!Schema::hasColumn('user_materi_progress', 'video_watch_percentage')) {
                $table->tinyInteger('video_watch_percentage')->default(0)->after('video_total_duration');
            }

            // Track if user marked as complete
            if (!Schema::hasColumn('user_materi_progress', 'is_completed')) {
                $table->boolean('is_completed')->default(false)->after('completed_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_materi_progress', function (Blueprint $table) {
            // Drop columns
            if (Schema::hasColumn('user_materi_progress', 'content_scrolled_to_bottom')) {
                $table->dropColumn('content_scrolled_to_bottom');
            }

            if (Schema::hasColumn('user_materi_progress', 'video_watch_percentage')) {
                $table->dropColumn('video_watch_percentage');
            }

            if (Schema::hasColumn('user_materi_progress', 'is_completed')) {
                $table->dropColumn('is_completed');
            }
        });
    }
};
