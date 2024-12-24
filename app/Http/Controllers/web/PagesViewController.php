<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\PortalCard\Models\PortalCard;

use App\AppPlugin\PortalCard\Traits\TemplateConfigTraits;
use App\AppPlugin\Quiz\Models\AppQuizQuestion;

use App\AppPlugin\Quiz\Traits\QuizConfigTraits;
use App\Http\Controllers\WebMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Response;
use JeroenDesloovere\VCard\VCard;


class PagesViewController extends WebMainController {

    use QuizConfigTraits;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function quizView(Request $request) {

        $unitId = $request->unitId;
        $sectionId = $request->sectionId;

        $questions = AppQuizQuestion::query()
            ->where('unit_id',$unitId)
            ->where('section_id',$sectionId)
            ->with(['answers' => function ($query) {
                $query->whereNotNull('answer')->inRandomOrder();
            }])->get();

//        dd($questions);

        return view('quiz.index')->with([
            'questions' => $questions,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'web.index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';
        $pageView['page'] = 'web.index';

        $this->quizCat = QuizConfigTraits::loadQuizCat();
        View::share('quizCat', $this->quizCat);

        $quizCat = self::loadQuizCat(); // استدعاء الدالة التي تقوم بإرجاع الفئات
        $units = AppQuizQuestion::query()->get()->groupBy('unit_id');
        $questions = [];
        foreach ($units as $key => $value) {

            $question = [
                'name' => getNameFromCollect($quizCat['units'], $key, 'name'),
                'unit_id' => $key,
                'count' => count($value),
                'sectionList' => AppQuizQuestion::query()->where('unit_id', $key)->get()->groupBy('section_id'),
            ];


            array_push($questions, $question);
        }

//        dd($questions);
        return view('web.index')->with([
            'pageView' => $pageView,
            'questions' => $questions,

        ]);
    }


}
