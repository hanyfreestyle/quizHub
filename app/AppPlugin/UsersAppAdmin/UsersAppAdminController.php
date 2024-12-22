<?php

namespace App\AppPlugin\UsersAppAdmin;

use App\AppPlugin\UsersApp\Models\UsersApp;
use App\AppPlugin\UsersApp\Traits\UsersAppConfigTraits;
use App\AppPlugin\UsersApp\Traits\UsersAppQueryBuilderTraits;
use App\AppPlugin\UsersAppAdmin\Request\UsersAppAdminStoreRequest;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UsersAppAdminController extends AdminMainController {

    use CrudTraits;
    use UsersAppConfigTraits;
    use UsersAppQueryBuilderTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "UsersApp";
        $this->PrefixRole = 'UsersApp';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/usersApp.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new UsersApp();
        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'formName' => "UsersAppIndexFilter",
            'restore' => true,
        ];

        self::constructData($sendArr);
        self::loadPagePermission(array());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = UsersApp::onlyTrashed()->count();
        $currentRoute = Route::currentRouteName();

        if ($currentRoute == $this->PrefixRoute . '.indexArchived' or $currentRoute == $this->PrefixRoute . '.filterArchived') {
            $this->pageViewIndex = 'Archived';
            $filterRoute = ".filterArchived";
            $this->formName = "UsersAppIndexArchivedFilter";
            $pageData['TitlePage'] = $pageData['TitlePage'] . " | " . __('admin/resume.app_menu_list_archived');
        } elseif ($currentRoute == $this->PrefixRoute . '.SoftDelete') {
            $this->pageViewIndex = 'SoftDelete';
            $filterRoute = null;
            $this->formName = "SoftDeleteFilter";
        } else {
            $this->pageViewIndex = 'Index';
            $filterRoute = ".filter";
            $this->formName = "UsersAppIndexFilter";
            $pageData['TitlePage'] = $pageData['TitlePage'] . " | " . __('admin/resume.app_menu_list');
        }

        View::share('formName', $this->formName);
        View::share('pageViewIndex', $this->pageViewIndex);

        $session = self::getSessionData($request);
        $rowData = self::PageIndexQuery($this->config, $session, $this->pageViewIndex)->get();

        return view('AppPlugin.UsersAppAdmin.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'filterRoute' => $filterRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $pageViewIndex = $request->pageViewIndex;
            $formName = $request->formName;
            $session = self::getSessionDataAjax($formName);
            $rowData = self::PageIndexQuery($this->config, $session, $pageViewIndex);
            return self::PageViewColumns($rowData, $pageViewIndex)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new UsersApp();
        return view('AppPlugin.UsersAppAdmin.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".store",
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $id = checkUuid($id);
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = UsersApp::query()->where('uuid', $id)->firstOrFail();
        return view('AppPlugin.UsersAppAdmin.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".update",
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDeleteException($id) {
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function store(UsersAppAdminStoreRequest $request) {
        $password_temp = $request->input('phone') . '@' . rand(5000, 9999);
        $saveData = new UsersApp();
        $saveData->uuid = Str::uuid()->toString();
        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->name = $request->input('name');

        $saveData->phone = $request->input('phone');
        $saveData->phone_code = $request->input('countryCode_phone');
        $saveData->whatsapp = $request->input('whatsapp');
        if ($request->input('whatsapp')) {
            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
        }
        $saveData->email = $request->input('email');
        $saveData->password_temp = $password_temp;
        $saveData->password = Hash::make($password_temp);

        $saveData->save();
        return self::redirectWhere($request, $saveData->uuid, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(UsersAppAdminStoreRequest $request, $id) {
        $id = checkUuid($id);
        $saveData = UsersApp::query()->where('uuid', $id)->firstOrFail();
        $saveData->is_active = intval((bool)$request->input('is_active'));

        $saveData->name = $request->input('name');
        $saveData->phone = $request->input('phone');
        $saveData->phone_code = $request->input('countryCode_phone');
        $saveData->whatsapp = $request->input('whatsapp');
        if ($request->input('whatsapp')) {
            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
        }
        $saveData->email = $request->input('email');
        $saveData->save();
        return self::redirectWhere($request, $saveData->uuid, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function passwordEdit($id) {
        $id = checkUuid($id);
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = UsersApp::query()->where('uuid', $id)->firstOrFail();
        return view('AppPlugin.UsersAppAdmin.form_pass')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".update",
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function passwordUpdate($id, Request $request) {
        $request->validate([
            'password' => "required|min:8|confirmed",
        ]);
        $id = checkUuid($id);
        $rowData = UsersApp::query()->where('uuid', $id)->firstOrFail();
        $rowData->password = Hash::make($request->input('password'));
        $rowData->save();
        return self::redirectWhere($request, $rowData->id, $this->PrefixRoute . '.index');
    }
}
