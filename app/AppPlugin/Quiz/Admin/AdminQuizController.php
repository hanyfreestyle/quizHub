<?php

namespace App\AppPlugin\Quiz\Admin;


use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use App\AppPlugin\Quiz\Models\AppQuizAnswer;
use App\AppPlugin\Quiz\Models\AppQuizQuestion;
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

        $catArr['inputType'] = [
            (object)['id' => 'text', 'name' => 'Text'],
            (object)['id' => 'url', 'name' => 'Url'],
            (object)['id' => 'number', 'name' => 'Number'],
            (object)['id' => 'email', 'name' => 'Email'],
        ];
        $catArr['inputDir'] = [
            (object)['id' => 'ar', 'name' => 'Ar'],
            (object)['id' => 'en', 'name' => 'En'],
        ];
        $catArr['inputVip'] = [
            (object)['id' => '0', 'name' => 'غير فعال'],
            (object)['id' => '1', 'name' => 'موصى بيه'],
        ];
        View::share('catArr', $catArr);


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
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $rowData = AppQuizQuestion::query()->with('answers')->get();

        return view('AppPlugin.Quiz.index_t')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
        ]);

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



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {

            $rowData = self::PageIndexQuery();
            return self::PageViewColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageIndexQuery() {
        $table = 'app_quiz_questions';


        $data = DB::table("$table")->where('id', '>', 0);


        $data->select(
            "$table.id as id",
            "$table.question as question",
        );


        return $data;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageViewColumns($data) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })


            ->editColumn('Edit', function ($row) {
                return returnTableBut(route($this->PrefixRoute . ".edit", $row->id), __('admin/form.button_edit'), "i", "fas fa-pencil-alt");
            })

            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })


            ->rawColumns(['Edit', "Delete", 'isActive', 'passwordEdit', 'isArchived', 'photo', 'ForceDelete', 'Restore']);
    }

}
