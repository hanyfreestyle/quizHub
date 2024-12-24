<?php

namespace App\AppPlugin\Quiz\Admin;


use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use App\AppPlugin\Quiz\Models\AppQuizAnswer;
use App\AppPlugin\Quiz\Models\AppQuizQuestion;
use App\AppPlugin\Quiz\Traits\QuizConfigTraits;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class AdminQuizController extends AdminMainController {


    function __construct() {

        parent::__construct();
        $this->controllerName = "PortalQuiz";
        $this->PrefixRole = 'PortalQuiz';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/quiz.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];

        $this->config = [
            'singlePage' => true,
            'addAlternate' => true,
            'addPhoto' => true,
            'langAr' => true,
            'langEn' => false,
        ];
        View::share('Config', $this->config);
        self::loadConstructData($sendArr);


        $this->quizCat = QuizConfigTraits::loadQuizCat();
        View::share('quizCat', $this->quizCat);
        $this->formName = "FilterEslamDarwish";
        View::share('formName', $this->formName);



        $permission = [
            'sub' => 'sitemap_view',
            'view' => ['index', 'Robots', 'GoogleCode'],
            'edit' => ['UpdateSiteMap', 'RobotsUpdate', 'GoogleCodeUpdate'],
        ];
//        self::loadPagePermission($permission);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('XXXXXXXXXX');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $session = self::getSessionData($request);
        $rowData = self::QuizDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.Quiz.index_t')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
        ]);

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::QuizDataFilterQ(self::indexQuery(), $session);
            return self::PageViewColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = 'app_quiz_questions';
        $data = DB::table("$table")->where('id', '>', 0);

        $data->select(
            "$table.id as id",
            "$table.class_id as class_id",
            "$table.subject_id as subject_id",
            "$table.term_id  as term_id",
            "$table.unit_id as unit_id",
            "$table.section_id as section_id",
            "$table.question as question",
        );

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function QuizDataFilterQ($query, $session, $order = null) {

        if (isset($session['section_id']) and $session['section_id'] != null) {
            $query->where('section_id', $session['section_id']);
        }

        if (isset($session['unit_id']) and $session['unit_id'] != null) {
            $query->where('unit_id', $session['unit_id']);
        }

//        if (isset($session['gender_id']) and $session['gender_id'] != null) {
//            $query->where('gender_id', $session['gender_id']);
//        }
//
//        if (isset($session['country_id']) and $session['country_id'] != null) {
//            $query->where('country_id', $session['country_id']);
//        }
//
//        if (isset($session['city_id']) and $session['city_id'] != null) {
//            $query->where('city_id', $session['city_id']);
//        }
//
//        if (isset($session['area_id']) and $session['area_id'] != null) {
//            $query->where('area_id', $session['area_id']);
//        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageViewColumns($data) {


        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('unit_id', function ($row) {
                $name = getNameFromCollect($this->quizCat['units'], $row->unit_id, 'name');
                return $name;
            })
            ->editColumn('section_id', function ($row) {
                $name = getNameFromCollect($this->quizCat['sections'], $row->section_id, 'name');
                return $name;
            })
            ->editColumn('Edit', function ($row) {
                return returnTableBut(route($this->PrefixRoute . ".edit", $row->id), __('admin/form.button_edit'), "i", "fas fa-pencil-alt");
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'isActive', 'passwordEdit', 'isArchived', 'photo', 'ForceDelete', 'Restore']);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new AppQuizQuestion();
        $title = __('admin/portalCard.form_add');
        return view('AppPlugin.Quiz.form')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
            'title' => $title
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function store(Request $request) {
        // التحقق من صحة البيانات
        $validated = $request->validate([
//            'question' => 'required|string',
//            'answers' => 'required|array|min:4',
//            'answers.*' => 'string',
//            'correct_answer' => 'required|integer|exists:app_quiz_answers,id',
        ]);

        // إضافة السؤال
        $question = new AppQuizQuestion();
        $question->question = $request->input('question');
        $question->position = 0;
        $question->save();

        // إضافة الإجابات
        foreach ($request->input('answers') as $index => $answerText) {  // استخدم اسم متغير مناسب
            $isCorrect = $index + 1 == $request->input('correct_answer') ? 1 : 0;

            // إنشاء إجابة جديدة
            $answer = new AppQuizAnswer();
            $answer->question_id = $question->id;
            $answer->answer = $answerText;  // استخدم القيمة الصحيحة هنا
            $answer->is_correct = $isCorrect;

            $answer->save();
        }

        return redirect()->route($this->PrefixRoute . '.create')->with('success', 'تم إضافة السؤال والإجابات بنجاح');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $question = AppQuizQuestion::query()->where('id', $id)->with('answers')->firstOrFail();

        $title = '';
        return view('AppPlugin.Quiz.form_edit')->with([
            'question' => $question,
            'pageData' => $pageData,
            'title' => $title
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function update(Request $request, $questionId) {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'question' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*' => 'nullable|string',
            'correct_answer' => 'required|integer|exists:app_quiz_answers,id',
        ]);

        // استرجاع السؤال
        $question = AppQuizQuestion::findOrFail($questionId);
        $question->question = $request->input('question');
        $question->position = 0;  // يمكن تعديل هذه القيمة حسب الحاجة
        $question->save();

        // تحديث الإجابات
        foreach ($request->input('answers') as $index => $answerText) {
            $isCorrect = $index + 1 == $request->input('correct_answer') ? 1 : 0;

            // تحديث الإجابة بناءً على السؤال
            $answer = AppQuizAnswer::where('question_id', $question->id)
                ->where('id', $request->input('answer_ids')[$index])
                ->first();

            if ($answer) {
                $answer->answer = $answerText;
                $answer->is_correct = $isCorrect;
                $answer->save();
            }
        }

        return redirect()->route($this->PrefixRoute . '.edit', ['id' => $questionId])->with('success', 'تم تحديث السؤال والإجابات بنجاح');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function delete($id) {
        $deleteRow = AppQuizQuestion::where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }




}
