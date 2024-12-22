<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('app_quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question')->nullable();
//            $table->integer('answer_id')->nullable(); // إذا كنت تحتاج فقط لإجابة واحدة، هذا العمود يمكن أن يشير إلى الإجابة الصحيحة.
            $table->integer('position')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('app_quiz_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('question_id')->unsigned();
            $table->string('answer')->nullable();
            $table->boolean('is_correct')->default(0);
            $table->foreign('question_id')->references('id')->on('app_quiz_questions')->onDelete('cascade'); // إنشاء العلاقة بين الأسئلة والإجابات
        });


    }

    public function down(): void {
        Schema::dropIfExists('app_quiz_answers');
        Schema::dropIfExists('app_quiz_questions');
    }

};
