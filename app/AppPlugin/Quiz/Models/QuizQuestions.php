<?php

namespace App\AppPlugin\Quiz\Models;


use Illuminate\Database\Eloquent\Model;


class QuizQuestions extends Model {
    protected $table = "app_card";
    protected $primaryKey = 'id';
    protected $fillable = [''];

    public function answers() {
        return $this->hasMany(QuizAnswers::class, 'question_id');
    }


}
