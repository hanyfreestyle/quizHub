<?php

return [

    "Meta" => [
        "name" => true,
    ],

    "Country" => [
        "seo" => true,
    ],

    "City" => [
        "seo" => true,
        "add_photo" => false,
        "add_country" => true,
        "def_country" => 169,
        "deleteData" => false
    ],

    "Area" => [
        "seo" => true,
        "add_photo" => false,
        "add_country" => true,
        "def_country" => 169,
        "add_city" => true,
        "def_city" => null,
        "deleteData" => false
    ],

    "ConfigData" => [
        "deleteData" => false
    ],
];
