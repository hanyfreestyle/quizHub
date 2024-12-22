<?php

namespace App\AppPlugin\AppPuzzle;


use App\AppCore\Menu\AdminMenuController;
use App\Helpers\MinifyTools;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;


class AppPuzzleFun {

    public $folderDate;
    public $mainFolder;

    function __construct() {
        $this->mainFolder = "D:\_AppPluginTest/";
        $this->mainFolder = "D:\_appPlugin202408/";
        $this->folderDate = null;

        $adminMenu = AdminMenuController::CashAdminMenu();
        View::share('adminMenu', $adminMenu);


        $this->agent = new Agent();
        View::share('agent', $this->agent);

        $this->MinifyTools = new MinifyTools();
        $this->minType = "Seo";
        $this->reBuild = true;
        View::share('MinifyTools', $this->MinifyTools);
        View::share('minType', $this->minType);
        View::share('reBuild', $this->reBuild);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function creatCopyFolder($thisModel) {
        $CopyFolder = $this->mainFolder . $thisModel['CopyFolder'] . '/';
        self::folderMakeDirectory($CopyFolder);
        return $CopyFolder;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function recursive_files_copy($source_dir, $destination_dir) {
        // Open the source folder / directory
        $dir = opendir($source_dir);

        // Create a destination folder / directory if not exist
        if (!File::isDirectory($destination_dir)) {
            self::folderMakeDirectory($destination_dir);
        }
        // Loop through the files in source directory
        while ($file = readdir($dir)) {
            // Skip . and ..
            if (($file != '.') && ($file != '..')) {
                // Check if it's folder / directory or file
                if (is_dir($source_dir . '/' . $file)) {
                    // Recursively calling this function for sub directory
                    self::recursive_files_copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
                } else {
                    // Copying the files
                    // copy($source_dir.'/'.$file, $destination_dir.'/'.$file);
                    File::copy($source_dir . '/' . $file, $destination_dir . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function folderMakeDirectory($destinationFolder) {
        if (!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0777, true, true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function checkSoursFolder($row) {
        if (isset($row['appFolder'])) {
            $thisDir = app_path("AppPlugin/" . $row['appFolder']);
            if (File::isDirectory($thisDir)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function checkSoursClientFolder($row) {

        $thisDir = public_path("db/" . $row['folderName']);
        if (File::isDirectory($thisDir)) {
            return true;
        } else {
            return false;
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function checkBackupFolder($row) {
        if (isset($row['CopyFolder'])) {
            $xx = new AppPuzzleController();
            $thisDir = $xx->mainFolder . $row['CopyFolder'];
            if (File::isDirectory($thisDir)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
