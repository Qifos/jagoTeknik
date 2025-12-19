<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // tambahkan hanya kalau belum ada
            if (!Schema::hasColumn('user', 'avatar')) {
                $table->string('avatar')->nullable()->after('foto_profil');
            }
            if (!Schema::hasColumn('user', 'dark_mode')) {
                $table->boolean('dark_mode')->default(false);
            }
            if (!Schema::hasColumn('user', 'messenger_color')) {
                $table->string('messenger_color', 10)->default('#2180f3');
            }
            if (!Schema::hasColumn('user', 'active_status')) {
                $table->boolean('active_status')->default(true);
            }
            if (!Schema::hasColumn('user', 'last_seen')) {
                $table->timestamp('last_seen')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'dark_mode',
                'messenger_color',
                'active_status',
                'last_seen',
            ]);
        });
    }
};
