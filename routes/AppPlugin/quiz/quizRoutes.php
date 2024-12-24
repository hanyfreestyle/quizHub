<?php

use App\AppPlugin\Quiz\Admin\AdminQuizController;
use Illuminate\Support\Facades\Route;


Route::prefix('quiz')->name('PortalQuiz.')
    ->controller(AdminQuizController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'index')->name('filter');
        Route::get('/DataTable', 'DataTable')->name('DataTable');
        Route::get('/disabled', 'index')->name('indexDisabled');
        Route::get('/vip', 'index')->name('indexVip');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/store/', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/destroy/{id}', 'delete')->name('destroy');
        Route::post('/sortInput', 'sortInputSave')->name('sortInput');
        Route::post('/sortInputVip', 'sortInputVip')->name('sortInputVip');
        Route::post('/toggleStatus', 'toggleStatus')->name('toggleStatus');

        Route::put('/{id}/update-existing-suggestions', 'updateExistingSuggestions')->name('updateExistingSuggestions');
        Route::delete('/suggestion/{id}', 'deleteExistingSuggestions')->name('deleteExistingSuggestions');
        Route::post('/{id}/add-new-suggestions', 'addNewSuggestions')->name('addNewSuggestions');
    });
