<?php

use App\AppPlugin\PortalCard\Admin\PortalCardInputController;
use Illuminate\Support\Facades\Route;


Route::prefix('portal-card')->name('PortalCard.')->controller(PortalCardInputController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/disabled', 'index')->name('indexDisabled');
    Route::get('/vip', 'index')->name('indexVip');
    Route::get('/create', 'create')->name('create');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/saveUpdate/{id}', 'saveUpdate')->name('saveUpdate');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::post('/sortInput', 'sortInputSave')->name('sortInput');
    Route::post('/sortInputVip', 'sortInputVip')->name('sortInputVip');
    Route::post('/toggleStatus', 'toggleStatus')->name('toggleStatus');

    Route::put('/{id}/update-existing-suggestions', 'updateExistingSuggestions')->name('updateExistingSuggestions');
    Route::delete('/suggestion/{id}', 'deleteExistingSuggestions')->name('deleteExistingSuggestions');
    Route::post('/{id}/add-new-suggestions', 'addNewSuggestions')->name('addNewSuggestions');
});
