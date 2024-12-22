<?php

namespace App\AppPlugin\Quiz\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class QuizAnswers extends Model {
    protected $table = "app_quiz_questions";
    protected $primaryKey = 'id';
    protected $fillable = [''];
    public $timestamps = false;


    public function question(): BelongsTo {
        return $this->belongsTo(QuizQuestions::class, 'question_id', 'id');
    }

}
