<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('app_quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('answer')->nullable();
            $table->timestamps();
        });

        Schema::create('app_quiz_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->string('name')->nullable();

        });

    }

    public function down(): void {
        Schema::dropIfExists('app_quiz_answers');
        Schema::dropIfExists('app_quiz_questions');
    }

};
