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
        Schema::create('user_materi_progress', function (Blueprint $table) {
            $table->id('id_user_materi_progress');

            // Foreign keys
            $table->integer('id_user');
            $table->integer('id_materi');
            $table->integer('id_matkul');

            // Progress tracking
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->boolean('video_completed')->default(false);
            $table->integer('video_watched_duration')->default(0); // in seconds
            $table->integer('video_total_duration')->default(0); // in seconds
            $table->boolean('content_read')->default(false);
            $table->integer('scroll_depth')->default(0); // percentage 0-100

            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('last_accessed_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_materi')->references('id_materi')->on('materi')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('cascade');

            // Composite unique constraint
            $table->unique(['id_user', 'id_materi']);

            // Indexes
            $table->index('id_user');
            $table->index('id_materi');
            $table->index('id_matkul');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_materi_progress');
    }
};
