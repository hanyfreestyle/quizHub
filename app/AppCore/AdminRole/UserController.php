<?php

namespace App\AppCore\AdminRole;

use App\AppCore\AdminRole\Request\UserRequest;
use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;


class UserController extends AdminMainController {

    use CrudTraits;

    function __construct(User $model) {

        parent::__construct();
        $this->controllerName = "UserList";
        $this->PrefixRole = 'users';
        $this->selMenu = "admin.users.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/roles.users_title');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'restore' => 1,
        ];
        self::loadConstructData($sendArr);

        $permission = [
            'edit' => ['updateStatus'],
        ];
        self::loadPagePermission($permission);

        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            $this->crmActive = true;
        }else{
            $this->crmActive = false;
        }
        View::share('crmActive', $this->crmActive);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('CashUsersList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = User::onlyTrashed()->count();
        $users = User::query()->where('id', '!=', 0)->get();
        $roles = Role::all();
        return view('admin.appCore.role.user_index')->with([
            'pageData' => $pageData,
            'users' => $users,
            'roles' => $roles,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $roles = array();
        $users = self::getSelectQuery(User::onlyTrashed());
        self::ClearCash();
        return view('admin.appCore.role.user_index')->with([
            'pageData' => $pageData,
            'users' => $users,
            'roles' => $roles,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['passReq'] = true;
        $users = User::findOrNew(0);
        $roles = Role::all();
        $team = User::query()->where('id', '!=', 0)->get();
        return view('admin.appCore.role.user_form')->with([
            'pageData' => $pageData,
            'users' => $users,
            'roles' => $roles,
            'team' => $team,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['passReq'] = false;
        $pageData['ViewType'] = "Edit";

        $users = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $users->roles->pluck('name', 'id')->all();
        $team = User::query()->where('id', '!=', $id)->get();
        return view('admin.appCore.role.user_form')->with([
            'pageData' => $pageData,
            'users' => $users,
            'roles' => $roles,
            'userRole' => $userRole,
            'team' => $team,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(UserRequest $request, $id = 0) {

        $saveData = User::findOrNew($id);
        $saveData->name = $request->name;
        $saveData->email = $request->email;
        $saveData->phone = $request->phone;
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->des = $request->des;
        $saveData->crm_crm = $request->input('crm_crm');
        $saveData->crm_sales = $request->input('crm_sales');
        $saveData->crm_tech = $request->input('crm_tech');
        $saveData->crm_team = $request->input('crm_team');

        if (trim($request->user_password != '')) {
            $saveData->password = Hash::make($request->user_password);
        }

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setUploadDirIs('user-profile')->setnewFileName($request->input('name'));

        $saveImgData->UploadOneNofilter($request, '4', 300, 300);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData, 'photo');

        $saveImgData->UploadOneNofilter($request, '4', 100, 100);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData, 'photo_thum_1');


        $saveData->roles_name = $request->input('roles');
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $saveData->assignRole($request->input('roles'));

        $saveData->save();
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroy($id) {
        if ($id != '1') {
            $deleteRow = self::DeleteQuery(User::where('id', $id))->firstOrFail();
            $deleteRowCount = self::deleteRowCount($deleteRow);
            if ($deleteRowCount == 0) {
                try {
                    DB::transaction(function () use ($deleteRow, $id) {
                        $deleteRow->forceDelete();
                    });
                } catch (\Exception $exception) {
                    return back()->with(['confirmException' => '', 'fromModel' => 'UsersPost', 'deleteRow' => $deleteRow]);
                }
            } else {
                return back()->with(['confirmException' => '', 'fromModel' => 'UsersPost', 'deleteRow' => $deleteRow]);
            }
            self::ClearCash();
            return redirect(route($this->PrefixRoute . '.index'))->with('confirmDelete', "");
        } else {
            self::ClearCash();
            return back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DeleteQuery($query) {
        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $query->withCount('del_post');
        }
        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function deleteRowCount($deleteRow) {
        $deleteRowCount = 0;
        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $deleteRowCount = $deleteRowCount + intval($deleteRow->del_post_count);
        }
        return $deleteRowCount;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateStatus(Request $request) {
        $userId = $request->send_id;
        if ($userId != '1') {
            $updateData = User::findOrFail($userId);
            if ($updateData->status == '1') {
                $updateData->status = '0';
            } else {
                $updateData->status = '1';
            }
            $updateData->save();
            self::ClearCash();
            return response()->json(['success' => $userId]);
        }
    }

}



