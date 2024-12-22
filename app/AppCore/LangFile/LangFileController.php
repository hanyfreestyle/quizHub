<?php

namespace App\AppCore\LangFile;

use App\AppCore\Menu\AdminMenu;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\MainModelFileTraits;
use App\Http\Traits\Files\PortalCardFileTraits;
use App\Http\Traits\Files\ProductFileTraits;
use App\Http\Traits\Files\QuizFileTraits;
use App\Http\Traits\Files\UsersAppFileTraits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class LangFileController extends AdminMainController {

    public $controllerName;

    function __construct() {
        parent::__construct();
        $this->controllerName = "adminlang";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin.app_menu_lang_admin');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];
        self::loadConstructData($sendArr);

        $selId = AdminHelper::arrIsset($_GET, 'id', '');
        View::share('selId', $selId);

        if (!config('app.ADMIN_LANG')) {
            abort('403');
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       ShowList
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $LangMenu = self::getLangMenu();
        $AppLang = config('app.admin_lang');
        $rowData = self::getDataTableLang($LangMenu, $AppLang);

        return view('admin.appCore.lang.admin_index')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
                'LangMenu' => $LangMenu,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getLangMenu() {
        $LangMenu = config('adminLangFile.adminFile');

        $LangMenu = UsersAppFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = PortalCardFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = AppSettingFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = DataFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = ProductFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = MainModelFileTraits::LoadLangFiles($LangMenu);
        $LangMenu = QuizFileTraits::LoadLangFiles($LangMenu);

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function EditLang() {

        $listFile = self::getLangMenu();
        $mergeData = [];
        $allData = [];
        $prefixCopy = "";
        $ViewData = 0;
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if (isset($_GET['id']) and isset($listFile[$_GET['id']])) {
            $ViewData = '1';
            $id = trim($_GET['id']);
            $prefixCopy = LangFileController::getPrefixCopy($listFile[$id]);

            foreach (config('app.admin_lang') as $key => $lang) {
                $FullPathToFile = LangFileController::getFullPathToFileArr($listFile[$id], $key);
                $GetData = File::getRequire($FullPathToFile);
                $result = array();
                foreach ($GetData as $Mainkey => $value) {
                    if (is_array($value)) {
                        $newSubArr = [];
                        foreach ($value as $subKey => $subvalue) {
                            $newSubArr += [$Mainkey . "_" . $subKey => $subvalue];
                        }
                        $result = array_merge($result, $newSubArr);
                    } else {
                        $result[$Mainkey] = $value;
                    }
                }
                $allData += [$key => $result];
                $mergeData = array_merge($mergeData, $result);
            }
        }

        ksort($mergeData);


        return view('admin.appCore.lang.admin_edit')->with(
            [
                'pageData' => $pageData,
                'mergeData' => $mergeData,
                'allData' => $allData,
                'prefixCopy' => $prefixCopy,
                'ViewData' => $ViewData,
                'listFile' => $listFile,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function updateFile(LangFileRequest $request) {

        $id = $request->file_id;
        $listFile = self::getLangMenu();
        $contentAsArr = [];

        foreach (config('app.admin_lang') as $key => $lang) {
            $FullPathToFile = LangFileController::getFullPathToFileArr($listFile[$id], $key);
            $content = "<?php\n\nreturn\n[\n";
            $index = 0;
            foreach ($request->key as $keyfromrequest) {
                if (trim($keyfromrequest) != '') {
                    $keyfromrequest = AdminHelper::Url_Slug($keyfromrequest, ['delimiter' => '_']);
                    $contentAsArr += [$keyfromrequest => $request->$key[$index]];
                    $content .= "\t'" . $keyfromrequest . "' => '" . htmlentities($request->$key[$index]) . "',\n";
                }
                $index++;
            }
            $content .= "];";
            File::put($FullPathToFile, $content);
        }
        return back()->with('Update.Done', '');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getFullPathToFileArr($row, $key) {
        if ($row['group'] != null) {
            $groupFolder = $row['group'] . "/";
            $fullPath = resource_path("lang/$key/" . $row['group']);
            if (!File::isDirectory($fullPath)) {
                File::makeDirectory($fullPath, 0777, true, true);
            }
        } else {
            $groupFolder = "";
        }

        if (isset($row['sub_dir']) and $row['sub_dir'] != null) {
            $subDirFolder = $row['sub_dir'] . "/";

            $fullPathSubDir = resource_path("lang/$key/" . $row['group'] . "/" . $row['sub_dir']);
            if (!File::isDirectory($fullPathSubDir)) {
                File::makeDirectory($fullPathSubDir, 0777, true, true);
            }
        } else {
            $subDirFolder = "";
        }

        $saveFileName = $row['file_name'] . ".php";
        $fullPathFile = resource_path("lang/$key/" . $groupFolder . $subDirFolder . $saveFileName);

        if (!File::isFile($fullPathFile)) {
            $content = "<?php\n\nreturn\n[\n";
            $content .= "];";
            File::put($fullPathFile, $content);
        }
        return $fullPathFile;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getPrefixCopy($row) {
        $line = "";
        if ($row['group'] != null) {
            $line .= $row['group'] . "/";
        }
        if (isset($row['sub_dir']) and $row['sub_dir'] != null) {
            $line .= $row['sub_dir'] . "/";
        }
        $line .= $row['file_name'] . ".";
        return $line;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getDataTableLang($LangMenu, $AppLang) {
        $listFile = $LangMenu;
        $rowData = [];
        foreach ($AppLang as $key => $lang) {
            $rowData[$key] = [];
            if (isset($_GET['id']) and isset($listFile[$_GET['id']])) {
                $id = trim($_GET['id']);
                $prefixCopy = LangFileController::getPrefixCopy($listFile[$id]);
                $FullPathToFile = LangFileController::getFullPathToFileArr($listFile[$id], $key);
                $GetData = File::getRequire($FullPathToFile);
                $GetData[$key] = File::getRequire($FullPathToFile);
                foreach ($GetData[$key] as $keyVar => $tran) {
                    array_push($rowData[$key], ['filekey' => $id, "name_" . $key => $tran, 'keyVar' => $keyVar, 'prefixCopy' => $prefixCopy . $keyVar]);
                }
            } else {
                foreach ($listFile as $filekey => $fileVall) {
                    $prefixCopy = LangFileController::getPrefixCopy($listFile[$filekey]);
                    $FullPathToFile = LangFileController::getFullPathToFileArr($listFile[$filekey], $key);
                    $GetData[$key] = File::getRequire($FullPathToFile);
                    foreach ($GetData[$key] as $keyVar => $tran) {
                        array_push($rowData[$key], ['filekey' => $filekey, "name_" . $key => $tran, 'keyVar' => $keyVar, 'prefixCopy' => $prefixCopy . $keyVar]);
                    }
                }
            }
        }

        $countLoop = 0;
        foreach ($AppLang as $key => $lang) {
            $countLoop = intval($countLoop) + count($rowData[$key]);
        }

        $forloop = $countLoop / count($AppLang);
        $LastData = [];
        for ($i = 0; $i < $forloop; $i++) {
            $langloop = [];
            foreach ($AppLang as $key => $lang) {
                $langloop += $rowData[$key][$i] ?? [];
            }
            array_push($LastData, $langloop);
        }

        return $LastData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function AdminMenu() {
        $mainMenu = new AdminMenu();
        $mainMenu->type = "One";
        $mainMenu->sel_routs = "admin.adminlang";
        $mainMenu->url = "admin.adminlang.index";
        $mainMenu->name = "admin.app_menu_lang_admin";
        $mainMenu->icon = "fas fa-language";
        $mainMenu->roleView = "adminlang_view";
        $mainMenu->is_active = true;
        $mainMenu->position = 100;
        $mainMenu->save();
    }

}
