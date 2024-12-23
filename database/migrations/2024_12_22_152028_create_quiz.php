<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('app_quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();

            $table->text('question')->nullable();
            $table->integer('position')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('app_quiz_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->text('answer')->nullable();
            $table->boolean('is_correct')->default(0);
            $table->foreign('question_id')->references('id')->on('app_quiz_questions')->onDelete('cascade'); // إنشاء العلاقة بين الأسئلة والإجابات
        });


    }

    public function down(): void {
        Schema::dropIfExists('app_quiz_answers');
        Schema::dropIfExists('app_quiz_questions');
    }

};
