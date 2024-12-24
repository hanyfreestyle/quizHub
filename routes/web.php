<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\RouteNotFoundController;
use App\Http\Controllers\web\PagesViewController;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => 'portal', 'middleware' => ['redirect_if_not_registered']], function () {
        Route::get('/', function () { return view('portal.dashboard'); });
    });
});


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => config('app.configAdminDir')], function () {
        Route::get('/admin-login', [AuthAdminController::class, 'AdminLogIn'])->name('admin.login');
        Route::post('/loginCheck', [AuthAdminController::class, 'AdminLoginCheck'])->name('AdminLoginCheck');
        Route::post('/logout', [AuthAdminController::class, 'AdminLogout'])->name('admin.logout');
    });
});

if (config('app.WEB_VIEW')) {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/under-construction', [WebMainController::class, 'UnderConstruction'])->name('UnderConstruction');
    });
} else {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/index', [WebMainController::class, 'NoIndex'])->name('NoIndex');
    });
}


Route::group(['middleware' => ['UnderConstruction', 'MinifyHtml']], function () {
    Route::get('/quiz/{unitId}/{sectionId}', [PagesViewController::class, 'quizView'])->name('web.quiz.quizView');
});

Route::group(['middleware' => ['UnderConstruction', 'MinifyHtml']], function () {
    Route::get('/c/{slug}', [PagesViewController::class, 'cardView'])->name('web.card.cardView');
    Route::get('/c/vcf/{slug}', [PagesViewController::class, 'downloadVcf'])->name('web.card.downloadVcf');
});

Route::group(['middleware' => ['UnderConstruction', 'MinifyHtml']], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/', [PagesViewController::class, 'index'])->name('web.index');
        Route::get('/contact-us', [PagesViewController::class, 'index'])->name('web.contact_us');
        Route::get('/about-us', [PagesViewController::class, 'index'])->name('web.about_us');
    });
});

Route::fallback(RouteNotFoundController::class);
