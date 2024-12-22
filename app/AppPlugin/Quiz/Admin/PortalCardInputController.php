<?php

namespace App\AppPlugin\PortalCard\Admin;


use App\AppPlugin\PortalCard\Models\PortalCardInput;
use App\AppPlugin\PortalCard\Models\PortalCardInputTranslation;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class PortalCardInputController extends AdminMainController {


    function __construct() {

        parent::__construct();
        $this->controllerName = "PortalCard";
        $this->PrefixRole = 'PortalCard';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/card.app_menu');
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
        Cache::forget('CashCardInputTemplate');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $currentRoute = Route::currentRouteName();
        View::share('currentRoute', $currentRoute);

        if ($currentRoute == $this->PrefixRoute . '.indexVip') {

            $rowData = PortalCardInput::query()
                ->where('vip', true)
                ->orderBy('position_vip')
                ->get();

            return view('AppPlugin.ConfigPortalCard.index_vip')->with([
                'rowData' => $rowData,
                'pageData' => $pageData,

            ]);

        } elseif ($currentRoute == $this->PrefixRoute . '.index') {
            $isActive = 1;
            $reloadRoute = $this->PrefixRoute . '.index';
            $orderBy =  'position';

        } elseif ($currentRoute == $this->PrefixRoute . '.indexDisabled') {
            $isActive = 0;
            $reloadRoute = $this->PrefixRoute . '.indexDisabled';
            $orderBy =  'position_vip';
        }

        $rowData = PortalCardInput::query()
            ->where('is_active', $isActive)
            ->orderBy('cat_id') // ترتيب المجموعات حسب cat_id
            ->orderBy($orderBy) // ترتيب العناصر داخل كل مجموعة
            ->get()
            ->groupBy('cat_id'); // تجميع العناصر حسب cat_id


        return view('AppPlugin.ConfigPortalCard.index')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
            'reloadRoute' => $reloadRoute,

        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new PortalCardInput();
        $title = __('admin/portalCard.form_add');
        return view('AppPlugin.ConfigPortalCard.form')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
            'title' => $title
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = PortalCardInput::query()->where('id', $id)->with('suggestion_list')->firstOrFail();

        $title = '<i class="' . $rowData->icon_i . '" ></i> ' . $rowData->input_id;
        return view('AppPlugin.ConfigPortalCard.form')->with([
            'rowData' => $rowData,
            'pageData' => $pageData,
            'title' => $title
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function saveUpdate(PortalCardInputRequest $request, $id) {
        if (intval($id) == 0) {
            $saveData = new PortalCardInput();
        } else {
            $saveData = PortalCardInput::query()->where('id', $id)->firstOrFail();
        }
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->cat_id = $request->input('cat_id');
                $saveData->vip = $request->input('vip');
                $saveData->input_id = $request->input('input_id');
                $saveData->name_key = $request->input('name_key');
                $saveData->icon_i = $request->input('icon_i');
                $saveData->url = $request->input('url');
                $saveData->url_user = $request->input('url_user');

                $saveData->regex = $request->input('regex');
                $saveData->err_ar = $request->input('err_ar');
                $saveData->err_en = $request->input('err_en');

                $saveData->type = $request->input('type');
                $saveData->input_dir = $request->input('input_dir');
                $saveData->save();

                foreach (config('app.portal_lang') as $key => $lang) {
                    $saveTranslation = PortalCardInputTranslation::where('input_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->input_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function addNewSuggestions(Request $request, $id) {
        $request->validate([
            'suggestions' => 'required|array',
            'suggestions.*.ar' => 'required|string|max:255',
            'suggestions.*.en' => 'required|string|max:255',
        ]);

        foreach ($request->suggestions as $suggestion) {
            // إضافة الاقتراح العربي
            PortalCardInputTranslation::create([
                'input_id' => $id,
                'locale' => 'ar',
                'suggestion' => $suggestion['ar'],
            ]);

            // إضافة الاقتراح الإنجليزي
            PortalCardInputTranslation::create([
                'input_id' => $id,
                'locale' => 'en',
                'suggestion' => $suggestion['en'],
            ]);
        }
        self::ClearCash();
        return redirect()->back()->with('success', 'New suggestions added successfully!');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function deleteExistingSuggestions($id) {
        PortalCardInputTranslation::findOrFail($id)->delete();
        self::ClearCash();
        return response()->json(['success' => true, 'message' => 'Suggestion deleted successfully!']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function delete($id) {
        $deleteRow = PortalCardInput::where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateExistingSuggestions(Request $request, $id) {
        $request->validate([
            'existingSuggestions' => 'required|array',
            'existingSuggestions.*.suggestion' => 'required|string|max:255',
        ]);
        foreach ($request->existingSuggestions as $suggestionId => $data) {
            $suggestion = PortalCardInputTranslation::findOrFail($suggestionId);
            $suggestion->update([
                'suggestion' => $data['suggestion'],
            ]);
        }
        self::ClearCash();
        return redirect()->back()->with('success', 'Suggestions updated successfully!');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function sortInputSave(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = PortalCardInput::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function sortInputVip(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = PortalCardInput::findOrFail($id);
            $saveData->position_vip = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function toggleStatus(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|boolean'
        ]);
        try {
            $input = PortalCardInput::findOrFail($request->id); // تعديل بناءً على اسم الموديل
            $input->is_active = $request->status;
            $input->save();
            self::ClearCash();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


}
