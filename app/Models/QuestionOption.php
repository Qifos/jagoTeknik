<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $table = 'question_options';
    protected $primaryKey = 'id_option';
    public $timestamps = true;

    protected $fillable = [
        'id_question',
        'option_text',
        'option_letter',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    // Relationships
    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question', 'id_question');
    }

    public function userAnswers()
    {
        return $this->hasMany(UserQuizAnswer::class, 'selected_option_id', 'id_option');
    }
}
