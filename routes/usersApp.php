<?php

use App\AppPlugin\PortalCard\CardsController;
use App\AppPlugin\PortalCard\CardTemplateController;
use App\AppPlugin\UsersApp\PortalProfileController;
use App\AppPlugin\UsersApp\UsersAppController;
use App\AppPlugin\UsersApp\UsersAppGuestController;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::prefix('portal')->name('portal.')->group(function () {
        Route::post('/save-theme', [UsersAppGuestController::class, 'saveTheme'])->name('saveTheme');
        Route::post('/save-toggle', [UsersAppGuestController::class, 'saveToggleSidebar'])->name('saveToggleSidebar');
    });
});

Route::group(['guest:customer'], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('portal')->name('portal.')->group(function () {
            Route::get('/login', [UsersAppGuestController::class, 'logIn'])->name('login');
            Route::post('/loginCheck', [UsersAppGuestController::class, 'logInCheck'])->name('loginCheck');
            Route::get('/sign-up', [UsersAppGuestController::class, 'SignUp'])->name('signUp');
            Route::post('/sign-up/create', [UsersAppGuestController::class, "SignUpCreate"])->name('signUpCreate');
            Route::get('/forget-password', [UsersAppGuestController::class, 'forgetPassword'])->name('forgetPassword');
            Route::post('/forget-password/send', [UsersAppGuestController::class, 'forgetPasswordSend'])->name('forgetPasswordSend');
            Route::get('/recovery-password/', [UsersAppGuestController::class, 'recoveryPassword'])->name('recoveryPassword');
        });
    });
});

Route::group(['auth:customer'], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('portal')->name('portal.')->group(function () {
            Route::get('/dash-board', [UsersAppController::class, 'dashBoard'])->name('dashboard');
            Route::get('/logout', [UsersAppController::class, 'logOut'])->name('logout');
        });
    });

    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('portal')->name('portal.profile.')->controller(PortalProfileController::class)->group(function () {
            // المسارات المتعلقة بالملف الشخصي
            Route::get('/edit-profile', 'editProfile')->name('editProfile');
            Route::post('/update-profile', 'updateProfile')->name('updateProfile');
            Route::get('/update-password', 'updatePassword')->name('updatePassword');
            Route::post('/save-new-password', 'saveNewPassword')->name('saveNewPassword');
            Route::get('profile/settings', 'profileSettings')->name('settings');

            // المسارات المتعلقة بالصور والبنرات
            Route::prefix('profile')->group(function () {
                Route::get('/update-photo', 'updateProfilePhoto')->name('updateProfilePhoto');
                Route::get('/update-banner', 'updateProfileBanner')->name('updateProfileBanner');
                Route::post('/upload-image', 'uploadImage')->name('uploadImage');
            });
        });
    });


    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('portal')->name('portal.cards.')->controller(CardsController::class)->group(function () {

            Route::get('/my-cards', 'cardsList')->name('cardsList');
            Route::get('/card/add', 'cardAdd')->name('cardAdd');
            Route::post('/card/create', 'cardCreate')->name('cardCreate');

            Route::get('/card/edit/{uuid}', 'cardEdit')->name('cardEdit')->whereUuid('uuid');
            Route::get('/card/edit/links/{uuid}', 'cardEditLinks')->name('cardEditLinks')->whereUuid('uuid');
            Route::get('/card/edit/sort/{uuid}', 'cardEditSort')->name('cardEditSort')->whereUuid('uuid');

            Route::get('/card/get/data', 'getDataInput')->name('getDataInput');
            Route::post('/card/update', 'cardUpdate')->name('cardUpdate');
            Route::post('/card/update-status', 'cardUpdateStatus')->name('cardUpdateStatus');
            Route::post('/card/delete', 'deleteItem')->name('deleteItem');

//            Route::get('/card/edit/photo-profile/{uuid}', 'cardEditPhotoProfile')->name('cardEditProfile')->whereUuid('uuid');
//            Route::get('/card/edit/photo-cover/{uuid}', 'cardEditPhotoCover')->name('cardEditCover')->whereUuid('uuid');
//            Route::post('/card/photo/upload', 'photoUpload')->name('photoUpload');

            Route::get('/card/data/get-card-preview', 'getCardPreview')->name('getCardPreview');
            Route::post('/card/data/update-job-title', 'updateJobTitle')->name('updateJobTitle');
            Route::post('/card/data/delete', 'deleteCardData')->name('deleteCardData');
            Route::post('/card/data/sort', 'dataSort')->name('updateCardOrder');
            Route::post('/card/data/edit', 'editCardData')->name('inputEditData');
            Route::post('/input/save-data', 'saveCardData')->name('inputSaveData');

            Route::get('/card/qr-code/popup', 'getQrCodePopUp')->name('getQrCodePopUp');
            Route::get('/card/qr-code/download/{uuid}', 'getQrCodeDownload')->name('getQrCodeDownload')->whereUuid('uuid');

        });
    });

    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('portal/c/')->name('portal.cards.')->controller(CardTemplateController::class)->group(function () {

            Route::get('/card/edit/them/{uuid}', 'cardEditTemplate')->name('cardEditTemplate')->whereUuid('uuid');
            Route::get('/template/edit/{uuid}', 'editTemplateSettings')->name('editTemplateSettings')->whereUuid('uuid');
            Route::post('/template/edit/save/{uuid}', 'saveTemplateSettings')->name('saveTemplateSettings');
            Route::get('/template/set-def/{uuid}', 'defSetTemplateCard')->name('defSetTemplateCard')->whereUuid('uuid');
            Route::get('/template/create/{uuid}/{layout_id}', 'createTemplateSettings')->name('createTemplateSettings')->whereUuid('uuid');

            Route::get('/template/photo/edit/{uuid}/{key}', 'editTemplatePhoto')
                ->name('editTemplatePhoto')
                ->whereUuid('uuid')->where('key', 'cover|profile');


            Route::get('/template/photo/delete/{uuid}/{key}', 'deleteTemplatePhoto')
                ->name('deleteTemplatePhoto')
                ->whereUuid('uuid')->where('key', 'cover|profile');

            Route::post('/template/photo/upload', 'templatePhotoUpload')->name('templatePhotoUpload');

        });
    });

});






