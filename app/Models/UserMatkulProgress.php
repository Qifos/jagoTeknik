<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatkulProgress extends Model
{
    use HasFactory;

    protected $table = 'user_matkul_progress';
    protected $primaryKey = 'id_user_matkul_progress';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_matkul',
        'id_beli_matkul',
        'status',
        'progress_percentage',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }

    public function beliMatkul()
    {
        return $this->belongsTo(BeliMatkul::class, 'id_beli_matkul', 'id_beli_matkul');
    }

    // Scope to get completed courses
    public function scopeCompleted($query)
    {
        return $query->where('status', 'selesai');
    }

    // Scope to get ongoing courses
    public function scopeOngoing($query)
    {
        return $query->where('status', 'di_ikuti');
    }

    // Method to calculate progress percentage based on completed materi
    public static function calculateProgress($userId, $matkulId)
    {
        $totalMateri = Materi::where('id_matkul', $matkulId)->count();

        if ($totalMateri === 0) {
            return 100;
        }

        $completedMateri = UserMateriProgress::where('id_user', $userId)
            ->where('id_matkul', $matkulId)
            ->where('status', 'completed')
            ->count();

        return round(($completedMateri / $totalMateri) * 100);
    }
}
