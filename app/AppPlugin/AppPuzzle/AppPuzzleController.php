<?php

namespace App\AppPlugin\AppPuzzle;

use App\AppPlugin\DirSchool\Models\School;
use App\Helpers\QueryBuilder;
use Hamcrest\Type\IsArray;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class AppPuzzleController extends AppPuzzleFun {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function IndexPuzzle() {
        $selRoute = null;

        $this->appPuzzle = new AppPuzzleController();
        View::share('appPuzzle', $this->appPuzzle);

        if (config('app.puzzle_active') == false) {
            return abort(403);
        }

        if (Route::currentRouteName() == 'admin.AppPuzzle.Config.IndexModel') {
            $rowData = AppPuzzleTreeConfig::tree();
            $selRoute = "Config";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Data.IndexModel') {
            $rowData = AppPuzzleTreeData::tree();
            $selRoute = "Data";

        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Model.IndexModel') {
            $rowData = AppPuzzleTreeModel::tree();
            $selRoute = "Model";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Product.IndexModel') {
            $rowData = AppPuzzleTreeProduct::tree();
            $selRoute = "Product";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Crm.IndexModel') {
            $rowData = AppPuzzleTreeCrm::tree();
            $selRoute = "Crm";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.crmService.IndexModel') {
            $rowData = AppPuzzleTreeCrmService::tree();
            $selRoute = "crmService";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Periodicals.IndexModel') {
            $rowData = AppPuzzleTreePeriodicals::tree();
            $selRoute = "Periodicals";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Dictionary.IndexModel') {
            $rowData = AppPuzzleTreeDictionary::tree();

            $selRoute = "Dictionary";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Client.IndexModel') {
            $selRoute = "Client";
            $rowData = ClientAppPuzzleTree::tree();
            return view('AppPlugin.AppPuzzle.index_client')->with([
                'rowData' => $rowData,
                'selRoute' => $selRoute,
            ]);
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Tools.IndexModel') {
            $rowData = AppPuzzleTreeTools::tree();
            $selRoute = "Tools";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.AppCore.IndexModel') {
            $rowData = AppPuzzleTreeAppCore::AppCore();
            $selRoute = "AppCore";
            return view('AppPlugin.AppPuzzle.index_core')->with([
                'rowData' => $rowData,
                'selRoute' => $selRoute,
            ]);
        }

        return view('AppPlugin.AppPuzzle.index_model')->with([
            'rowData' => $rowData,
            'selRoute' => $selRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LoadTreeData() {
        $Config = AppPuzzleTreeConfig::tree();
        $Model = AppPuzzleTreeModel::tree();
        $Data = AppPuzzleTreeData::tree();

        $Product = AppPuzzleTreeProduct::tree();
        $Crm = AppPuzzleTreeCrm::tree();
        $CrmService = AppPuzzleTreeCrmService::tree();
        $Periodicals = AppPuzzleTreePeriodicals::tree();
        $Dictionary = AppPuzzleTreeDictionary::tree();
        $AppCore = AppPuzzleTreeAppCore::AppCore();
        $Tools = AppPuzzleTreeTools::tree();
        $treeData = $Config + $Model + $Data + $Product + $Crm + $AppCore + $Periodicals + $Tools + $CrmService + $Dictionary;
        return $treeData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CopyModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $copy = new AppPuzzleFunCopy();

            $copy->copyAppFolder($thisModel);
            $copy->copyViewFolder($thisModel);
            $copy->copyRouteFile($thisModel);
            $copy->copyRouteFiles($thisModel);
            $copy->copyMigrations($thisModel);
            $copy->copyLangFile($thisModel);
            $copy->copyPhotoFolder($thisModel);
            $copy->copyAssetsFolder($thisModel);
            $copy->copyComponentFolder($thisModel);
            $copy->copyComponentFile($thisModel);
            $copy->copyLivewireFile($thisModel);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function RemoveModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $remove = new AppPuzzleFunRemove();
            $remove->removeAppFolder($thisModel);
            $remove->removeViewFolder($thisModel);
            $remove->removeRouteFile($thisModel);
            $remove->removeRouteFiles($thisModel);
            $remove->removeMigrations($thisModel);
            $remove->removeLangFiles($thisModel);
            $remove->removePhotoFolder($thisModel);
            $remove->removeAssetsFolder($thisModel);
            $remove->removeComponentFolder($thisModel);
            $remove->removeComponentFile($thisModel);
            $remove->removeLivewireFile($thisModel);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ImportModel($model) {
        $modelTree = self::LoadTreeData();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $destinationFolder = base_path();
            if (File::isDirectory($BackFolder)) {
                self::recursive_files_copy($BackFolder, $destinationFolder);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ImportClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $destinationFolder = base_path();
            if (File::isDirectory($BackFolder)) {
                self::recursive_files_copy($BackFolder, $destinationFolder);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function RemoveClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $FolderList = $thisModel['FolderList'];
            foreach ($FolderList as $folder) {
                if (File::isDirectory($folder)) {
                    File::deleteDirectory($folder);
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ExportClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();


        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $folderName = $thisModel['folderName'];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];


            $FolderList = $thisModel['FolderList'];
            foreach ($FolderList as $key => $value) {

                if ($key == 'db') {
                    $destinationFolder = $BackFolder . "/public/db/" . $folderName;
                } elseif ($key == 'config') {
                    $destinationFolder = $BackFolder . "/config_" . $folderName;
                } elseif ($key == 'adminLogo') {
                    $destinationFolder = $BackFolder . "/public/assets/admin/client/" . $folderName;
                } else {
                    $destinationFolder = null;
                }
                if (File::isDirectory($value)) {
                    self::recursive_files_copy($value, $destinationFolder);
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function exportDbBackUp($model) {
        $modelTree = ClientAppPuzzleTree::tree();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $folderName = "db/" . $thisModel['folderName'];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $exportDbBackUp = IsArr($modelTree[$model], "exportDbBackUp", false);

            if ($exportDbBackUp) {
                self::BackUpOldFiles($folderName);

                $files = File::files($folderName);

                foreach ($files as $file) {
                    $tableName = str_replace('.sql', '', $file->getFilename());
                    $sourceFolder = public_path($folderName);
                    if (!File::isDirectory($sourceFolder)) {
                        File::makeDirectory($sourceFolder, 0777, true, true);
                    }
                    self::exportSqlData($tableName, $sourceFolder . "/");
                }
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BackUpOldFiles($folderName) {

        $sourceFolder = public_path($folderName); // المجلد الرئيسي الذي يحتوي على الملفات
        $backupFolder = public_path($folderName . '-backup'); // مسار مجلد النسخ الاحتياطية
        $countLeave = 5;
        if (!File::exists($backupFolder)) {
            File::makeDirectory($backupFolder, 0777, true);
        }

        $gitignorePath = $backupFolder . DIRECTORY_SEPARATOR . '.gitignore';
        File::put($gitignorePath, "*\n!.gitignore");

        $timestamp = time();
        $newBackupFolder = $backupFolder . DIRECTORY_SEPARATOR . $timestamp;

        if (!File::exists($newBackupFolder)) {
            File::makeDirectory($newBackupFolder, 0777, true);
        }

        // نسخ الملفات من المجلد الرئيسي إلى مجلد النسخة الجديدة
        $files = File::files($sourceFolder);
        foreach ($files as $file) {
            $destinationPath = $newBackupFolder . DIRECTORY_SEPARATOR . $file->getFilename();
            File::copy($file->getPathname(), $destinationPath);
        }

        $backups = File::directories($backupFolder);
        if (count($backups) > $countLeave) {
            $sortedBackups = collect($backups)->sortBy(function ($folder) {
                return File::lastModified($folder);
            })->toArray();

            $foldersToDelete = array_slice($sortedBackups, 0, count($backups) - $countLeave);
            foreach ($foldersToDelete as $folder) {
                File::deleteDirectory($folder);
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function exportSqlData($tableName, $fullPath) {
        $data = DB::table($tableName)->get();
        if (count($data) > 0) {
            $sql = "INSERT INTO `$tableName` VALUES\n";
            $rows = [];
            foreach ($data as $row) {
                $values = array_map(function ($value) {
                    return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                }, (array)$row);

                $rows[] = '(' . implode(', ', $values) . ')';
            }
            $sql .= implode(",\n", $rows) . ";\n";
        } else {
            $sql = "";
            $sql .= 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";';
            $sql .= 'START TRANSACTION;';
            $sql .= 'SET time_zone = "+00:00";';
            $sql .= 'COMMIT;';
        }

        $fileName = $tableName . '.sql';
        file_put_contents($fullPath . $fileName, $sql);
    }
}
