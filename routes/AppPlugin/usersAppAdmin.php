<?php

use App\AppPlugin\UsersAppAdmin\UsersAppAdminController;
use Illuminate\Support\Facades\Route;


Route::prefix('users-app/')->name('UsersApp.')->controller(UsersAppAdminController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'index')->name('filter');
    Route::get('/archived', 'index')->name('indexArchived');
    Route::post('/archived', 'index')->name('filterArchived');
    Route::get('/soft-delete', 'index')->name('SoftDelete');
    Route::get('/DataTable/{pageViewIndex}/{formName}', 'DataTable')->name('DataTable');

    Route::get('/archivedUpdate/{id}', 'archivedUpdate')->name('archivedUpdate');
    Route::get('/activeUpdate/{id}', 'activeUpdate')->name('activeUpdate');


    Route::get('/create', 'create')->name('create');
    Route::post('/store/{id}', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'storeUpdate')->name('update');
    Route::get('/emptyPhoto/{id}', 'emptyPhoto')->name('emptyPhoto');

    Route::get('/password/{id}', 'passwordEdit')->name('passwordEdit');
    Route::post('/password-update/{id}', 'passwordUpdate')->name('passwordUpdate');

    Route::get('/destroy/{id}', 'destroy')->name('destroy');
    Route::get('/restore/{id}', 'Restore')->name('restore');
    Route::get('/force/{id}', 'ForceDeleteException')->name('force');
    Route::get('/config', 'config')->name('config');


});
