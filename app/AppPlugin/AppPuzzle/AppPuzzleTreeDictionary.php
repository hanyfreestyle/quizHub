<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeDictionary {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'SchoolDir' => self::treeSchool(),
            'Resume' => self::treeResume(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeSchool() {
        return [
            'view' => true,
            'id' => "SchoolDir",
            'CopyFolder' => "Dir_School",
            'appFolder' => 'DirSchool',
            'viewFolder' => 'DirSchool',
            'routeFolder' => "dir/",
            'routeFile' => 'school.php',
            'migrations' => [
                '2024_10_01_000001_create_dir_school_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['dir_school.php','dir_school_var.php','dir_school_export.php','dir_stages.php'],
            'ComponentFolderClass' => ['AppPlugin/School'],
            'ComponentFolderView' => ['app-plugin/school'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeResume() {
        return [
            'view' => true,
            'id' => "Resume",
            'CopyFolder' => "Resume",
            'appFolder' => 'Resume',
            'viewFolder' => 'Resume',
            'routeFolder' => null,
            'routeFile' => 'resume.php',
            'migrations' => [
                '2024_10_01_000001_create_resume_table.php',
            ],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['resume.php','resume_var.php','resume_export.php','pdf_temp.php'],
            'ComponentFolderClass' => ['AppPlugin/Resume'],
            'ComponentFolderView' => ['app-plugin/resume'],
        ];
    }


}
