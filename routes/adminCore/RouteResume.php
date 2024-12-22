<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/resume.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/resume.php'));
}



