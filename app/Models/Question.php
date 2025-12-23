<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id_question';
    public $timestamps = true;

    protected $fillable = [
        'id_materi',
        'question_text',
        'question_type',
        'difficulty_level',
    ];

    // Relationships
    public function materi()
    {
        return $this->belongsTo(Materi::class, 'id_materi', 'id_materi');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'id_question', 'id_question');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserQuizAnswer::class, 'id_question', 'id_question');
    }
}
