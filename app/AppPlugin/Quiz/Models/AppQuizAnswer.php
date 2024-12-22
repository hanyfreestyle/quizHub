<?php

namespace App\AppPlugin\Quiz\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AppQuizAnswer extends Model {
    protected $table = "app_quiz_answers";
    protected $primaryKey = 'id';
    protected $fillable = ['question_id','',];
    public $timestamps = false;


    public function question(): BelongsTo {
        return $this->belongsTo(AppQuizQuestion::class, 'question_id', 'id');
    }

}
