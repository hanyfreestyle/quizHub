<?php
return [
    'adminFile' => [
//        'admin'=> ['id'=> 'admin' , 'group'=>null ,'file_name'=> 'admin', 'name_en'=> "Admin Core" ,'name_ar'=> "لوحة التحكم " ],
//        'upFilter'=> ['id'=> 'upFilter' , 'group'=>'admin','sub_dir'=> 'config','file_name'=> 'upFilter','name'=>'Photo Filter','name_ar'=>'فلاتر الصور' ],
//        'dataTable'=> ['id'=> 'dataTable' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'dataTable','name'=>'dataTable','name_ar'=>'dataTable' ],
        'alertMass' => ['id' => 'alertMass', 'group' => 'admin', 'file_name' => 'alertMass', 'name_en' => 'Alert Mass', 'name_ar' => 'رسائل التحذير'],

//        'filter'=> ['id'=> 'filter', 'group'=>'admin', 'file_name'=> 'formFilter','name_en'=>'Filter Form','name_ar'=>'فلتر' ],
        'settings' => ['id' => 'settings', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'settings', 'name' => 'Settings', 'name_ar' => 'اعدادات الاقسام'],
//        'deleteMass'=> ['id'=> 'deleteMass','group'=>'admin','file_name'=>'deleteMass','name'=>'Delete Mass','name_ar'=>'رسائل الحذف' ],
        'def' => ['id' => 'def', 'group' => 'admin', 'file_name' => 'def', 'name_en' => 'Default Variables', 'name_ar' => 'المتغيرات الاساسية'],
        'defCat' => ['id' => 'defCat', 'group' => 'admin', 'file_name' => 'defCat', 'name_en' => 'Variables', 'name_ar' => 'متغيرات'],
        'webConfig' => ['id' => 'webConfig', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'webConfig', 'name_en' => 'web Config', 'name_ar' => 'اعدادات الموقع'],
        'roles' => ['id' => 'roles', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'roles', 'name_en' => 'Permissions', 'name_ar' => 'الصلاحيات'],
        'form' => ['id' => 'form', 'group' => 'admin', 'file_name' => 'form', 'name_en' => 'Forms', 'name_ar' => 'الفورم'],
    ],

    'webFile' => [
        'def' => ['id' => 'def', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'def', 'name_en' => 'Default Variables', 'name_ar' => 'المتغيرات الاساسية'],
        'menu' => ['id' => 'menu', 'group' => 'web', 'file_name' => 'menu', 'name_en' => 'Menu', 'name_ar' => 'القائمة'],
        'err404' => ['id' => 'err404', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'err404', 'name_en' => 'err404', 'name_ar' => 'err404'],
    ],


];
