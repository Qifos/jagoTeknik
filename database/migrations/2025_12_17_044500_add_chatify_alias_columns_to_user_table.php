<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        // tambah flag mentor
        Schema::table('user', function (Blueprint $table) {
            if (!Schema::hasColumn('user', 'is_mentor')) {
                $table->boolean('is_mentor')->default(false)->after('is_active');
            }
        });

        // alias kolom untuk kompatibilitas Chatify: id & name
        if (!Schema::hasColumn('user', 'id')) {
            DB::statement("ALTER TABLE `user`
                ADD COLUMN `id` BIGINT(20) UNSIGNED GENERATED ALWAYS AS (`id_user`) STORED");
        }

        if (!Schema::hasColumn('user', 'name')) {
            DB::statement("ALTER TABLE `user`
                ADD COLUMN `name` VARCHAR(255) GENERATED ALWAYS AS (`nama`) STORED");
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('user', 'name')) {
            DB::statement("ALTER TABLE `user` DROP COLUMN `name`");
        }
        if (Schema::hasColumn('user', 'id')) {
            DB::statement("ALTER TABLE `user` DROP COLUMN `id`");
        }

        Schema::table('user', function (Blueprint $table) {
            if (Schema::hasColumn('user', 'is_mentor')) {
                $table->dropColumn('is_mentor');
            }
        });
    }
};
