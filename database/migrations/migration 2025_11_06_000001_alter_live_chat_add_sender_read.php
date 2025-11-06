<?php
/**
 * Author : Ni Kadek Adelia Paramita Putri (NRP 5026231196)
 * File   : jagoteknik\database\migrations\migration 2025_11_06_000001_alter_live_chat_add_sender_read.php
 * Desc   : migration
 * Date   : 2025-11-06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::table('live_chat', function (Blueprint $table) {
            // === Tambah kolom sender_type (user / mentor)
            if (!Schema::hasColumn('live_chat', 'sender_type')) {
                $table->enum('sender_type', ['user','mentor'])
                      ->default('user')
                      ->after('id_mentor');
            }


            // === Tambah kolom is_read (penanda pesan sudah dibaca)
            if (!Schema::hasColumn('live_chat', 'is_read')) {
                // sesuaikan posisi setelah media_url atau media
                if (Schema::hasColumn('live_chat','media_url')) {
                    $table->boolean('is_read')->default(false)->after('media_url');
                } elseif (Schema::hasColumn('live_chat','media')) {
                    $table->boolean('is_read')->default(false)->after('media');
                } else {
                    $table->boolean('is_read')->default(false);
                }
            }


            // === Tambah kolom created_at & updated_at (timestamps)
            if (!Schema::hasColumn('live_chat', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('waktu');
            }
            if (!Schema::hasColumn('live_chat', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }


    public function down(): void
    {
        Schema::table('live_chat', function (Blueprint $table) {
            if (Schema::hasColumn('live_chat', 'sender_type')) {
                $table->dropColumn('sender_type');
            }
            if (Schema::hasColumn('live_chat', 'is_read')) {
                $table->dropColumn('is_read');
            }
            if (Schema::hasColumn('live_chat', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('live_chat', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
