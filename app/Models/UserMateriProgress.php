<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMateriProgress extends Model
{
    use HasFactory;

    protected $table = 'user_materi_progress';
    protected $primaryKey = 'id_user_materi_progress';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_materi',
        'id_matkul',
        'status',
        'video_completed',
        'video_watched_duration',
        'video_total_duration',
        'video_watch_percentage',
        'content_read',
        'content_scrolled_to_bottom',
        'scroll_depth',
        'started_at',
        'completed_at',
        'is_completed',
        'last_accessed_at',
        'quiz_completed',
        'highest_quiz_score',
        'recent_quiz_score',
        'quiz_passed',
        'last_quiz_attempt',
    ];

    protected $casts = [
        'video_completed' => 'boolean',
        'video_watch_percentage' => 'integer',
        'content_read' => 'boolean',
        'content_scrolled_to_bottom' => 'boolean',
        'is_completed' => 'boolean',
        'quiz_completed' => 'boolean',
        'quiz_passed' => 'boolean',
        'highest_quiz_score' => 'integer',
        'recent_quiz_score' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'last_quiz_attempt' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }

    // Scope to check if user completed all materi in a matkul
    public function scopeCompletedByUser($query, $userId, $matkulId)
    {
        return $query->where('id_user', $userId)
                     ->where('id_matkul', $matkulId)
                     ->where('status', 'completed');
    }

    // Scope to get next unlocked materi
    public function scopeNextMateri($query, $userId, $matkulId, $currentMateriId)
    {
        return $query->where('id_user', $userId)
                     ->where('id_matkul', $matkulId)
                     ->where('id_materi', '>', $currentMateriId)
                     ->where('status', '!=', 'locked')
                     ->orderBy('id_materi', 'asc')
                     ->first();
    }
}
