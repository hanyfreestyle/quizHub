<?php

namespace App\AppPlugin\Quiz\Models;


use Illuminate\Database\Eloquent\Model;


class AppQuizQuestion extends Model {
    protected $table = "app_quiz_questions";
    protected $primaryKey = 'id';
    protected $fillable = ['question','answer','is_correct'];

    public function answers() {
        return $this->hasMany(AppQuizAnswer::class, 'question_id');
    }


}
