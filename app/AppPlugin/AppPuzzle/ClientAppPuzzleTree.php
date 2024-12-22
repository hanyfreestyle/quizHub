<?php

namespace App\AppPlugin\AppPuzzle;

use App\AppPlugin\DirSchool\Traits\DirSchoolConfigTraits;
use App\Http\Traits\Files\DictionaryFileTraits;

class ClientAppPuzzleTree {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
//            'def' => self::treeClientData('def'),
//            'hoover' => self::treeClientData('hoover'),
//            'bookcaffe' => self::treeClientData('bookcaffe'),
//            'vonza' => self::treeClientData('vonza'),
//            'onfire' => self::treeClientData('onfire'),
            'school' => self::treeClientData('school',true),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeClientData($folderName,$exportDbBackUp=false,$exportDbName=array()) {
        return [
            'view' => true,
            'folderName' => $folderName,
            'id' => $folderName,
            'CopyFolder' => "_Clients/" . $folderName,
            'FolderList' => [
                'db' => public_path('db/' . $folderName),
                'config' => base_path('config_' . $folderName),
                'adminLogo' => public_path('assets\admin\client/' . $folderName),
            ],
            'exportDbBackUp'=> $exportDbBackUp ,
            'exportDbName'=> $exportDbName ,
        ];
    }

}
