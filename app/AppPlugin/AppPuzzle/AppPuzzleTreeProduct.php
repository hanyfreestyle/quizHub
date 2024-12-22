<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeProduct {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'Product' => self::treeProduct(),
            'UsersApp' => self::treeUsersApp(),
            'UsersAppAdmin' => self::treeUsersAppAdmin(),
            'Orders' => self::treeOrders(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeProduct() {
        return [
            'view' => true,
            'id' => "Product",
            'CopyFolder' => "Product",
            'appFolder' => 'Product',
            'viewFolder' => 'Product',
            'routeFolder' => null,
            'routeFile' => 'proProduct.php',

            'migrations' => [
                '2023_01_01_000001_create_products_table.php',
                '2023_01_02_000001_create_category_brand_table.php',
                '2023_01_03_000001_create_attributes_table.php',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['proProduct.php'],
            'webLangFolder' => "web/",
            'webLangFiles' => ['proProduct.php'],
            'assetsFolder' => null,
            'livewireClass' => null,
            'livewireView' => null,
            'ComponentFolderClass' => ['AppPlugin/Product'],
            'ComponentFolderView' => ['app-plugin/product'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeUsersApp() {
        return [
            'view' => true,
            'id' => "UsersApp",
            'CopyFolder' => "UsersApp",
            'appFolder' => 'UsersApp',
            'viewFolder' => 'UsersApp',
            'routeFolder' => null,
            'routeFile' => 'usersApp.php',
            'migrations' => [
                '2014_10_12_000002_create_users_app_table.php',
            ],

            'webLangFolder' => "web/",
            'webLangFiles' => ['profile.php'],
            'ComponentFolderClass' => ['AppPlugin/UsersApp'],
            'ComponentFolderView' => ['app-plugin/users-app'],

        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeUsersAppAdmin() {
        return [
            'view' => true,
            'id' => "UsersAppAdmin",
            'CopyFolder' => "UsersAppAdmin",
            'appFolder' => 'UsersAppAdmin',
            'viewFolder' => 'UsersAppAdmin',
            'routeFolder' => null,
            'routeFile' => 'usersAppAdmin.php',
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['usersApp.php'],
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeOrders() {
        return [
            'view' => true,
            'id' => "Orders",
            'CopyFolder' => "Orders",
            'appFolder' => 'Orders',
            'viewFolder' => 'Orders',
            'routeFolder' => null,
            'routeFile' => 'orders.php',
            'migrations' => [
                '2023_04_01_000001_create_shopping_order_table.php',
                '2023_05_01_000001_create_shopping_shipping_table.php',
            ],
            'seeder' => [
                'shopping_order_addresses.sql',
                'shopping_order_logs.sql',
                'shopping_order_products.sql',
                'shopping_orders.sql',
                'shopping_shipping_cat.sql',
                'shopping_shipping_rate.sql',
            ],

            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['orders.php'],
        ];
    }


}
