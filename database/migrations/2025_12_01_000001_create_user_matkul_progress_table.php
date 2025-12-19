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
        Schema::create('user_matkul_progress', function (Blueprint $table) {
            $table->id('id_user_matkul_progress');

            // Foreign keys
            $table->integer('id_user');
            $table->integer('id_matkul');
            $table->integer('id_beli_matkul')->nullable();

            // Status tracking
            $table->enum('status', ['di_ikuti', 'selesai'])->default('di_ikuti');
            $table->integer('progress_percentage')->default(0);

            // Timestamps
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_matkul')->references('id_matkul')->on('matkul')->onDelete('cascade');
            $table->foreign('id_beli_matkul')->references('id_beli_matkul')->on('beli_matkul')->onDelete('set null');

            // Composite unique constraint
            $table->unique(['id_user', 'id_matkul']);

            // Indexes
            $table->index('id_user');
            $table->index('id_matkul');
            $table->index('status');
            $table->index('progress_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_matkul_progress');
    }
};
