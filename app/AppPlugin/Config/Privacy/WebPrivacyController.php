<?php

namespace App\AppPlugin\Config\Privacy;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class WebPrivacyController extends AdminMainController {
    use CrudTraits;

    function __construct(WebPrivacy $model) {
        parent::__construct();
        $this->controllerName = "WebPrivacy";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/configPrivacy.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
        ];

        self::loadConstructData($sendArr);

        $permission = [
            'sub' => 'config_web_privacy',
            'edit' => ['Sort'],
        ];
        self::loadPagePermission($permission);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
//        $rowData = self::getSelectQuery(WebPrivacy::defquery());
        return view('AppPlugin.ConfigPrivacy.index')->with([
            'pageData' => $pageData,
//            'rowData' => $rowData,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {
        $table = 'config_web_privacy';
        $table_trans = "config_web_privacy_translations";
        $data = DB::table("$table");
        $data->join("$table_trans", "$table.id", '=', "$table_trans.privacy_id")
            ->where("$table_trans.locale", '=', dataTableDefLang())
            ->select(
                "$table.id as id",
                "$table_trans.h1 as name",
                "$table_trans.h2 as name2",
            );
        return $data;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $rowData = self::indexQuery();
            return self::TableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('name', function ($row) {
                return $row->name;
            })
            ->editColumn('name2', function ($row) {
                return $row->name2;
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'photo', 'isActive', 'name']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new WebPrivacy();
        return view('AppPlugin.ConfigPrivacy.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = WebPrivacy::findOrFail($id);
        return view('AppPlugin.ConfigPrivacy.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(WebPrivacyRequest $request, $id = '0') {

        $saveData = WebPrivacy::findOrNew($id);
        $saveData->name = $request->input('name');
        $saveData->save();

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = WebPrivacyTranslation::where('privacy_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->privacy_id = $saveData->id;
            $saveTranslation->locale = $key;
            $saveTranslation->h1 = $request->input($key . '.h1');
            $saveTranslation->h2 = $request->input($key . '.h2');
            $saveTranslation->des = $request->input($key . '.des');
            $saveTranslation->lists = $request->input($key . '.lists');
            $saveTranslation->save();
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Sort() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $WebPrivacy = WebPrivacy::with('translation')
            ->orderBy('position', 'asc')
            ->get();
        return view('AppPlugin.ConfigPrivacy.sort')->with([
            'pageData' => $pageData,
            'WebPrivacy' => $WebPrivacy,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = WebPrivacy::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }
}
