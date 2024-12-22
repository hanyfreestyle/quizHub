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




//Route::get('/portal-card', [PortalCardInputController::class, 'index'])->name('PortalCard.index');
//Route::get('/portal-card/create', [PortalCardInputController::class, 'create'])->name('PortalCard.create');
//Route::get('/portal-card/edit/{id}', [PortalCardInputController::class, 'edit'])->name('PortalCard.edit');
//Route::post('/portal-card/saveUpdate/{id}', [PortalCardInputController::class, 'saveUpdate'])->name('PortalCard.saveUpdate');
//Route::get('/portal-card/delete/{id}', [PortalCardInputController::class, 'delete'])->name('PortalCard.delete');
//Route::post('/portal-card/sortInput', [PortalCardInputController::class, 'sortInputSave'])->name('PortalCard.sortInput');
//Route::post('/portal-card/toggleStatus', [PortalCardInputController::class, 'toggleStatus'])->name('PortalCard.toggleStatus');
//
//Route::put('/portal-card/{id}/update-existing-suggestions', [PortalCardInputController::class, 'updateExistingSuggestions'])->name('PortalCard.updateExistingSuggestions');
//Route::delete('/portal-card/suggestion/{id}', [PortalCardInputController::class, 'deleteExistingSuggestions'])->name('PortalCard.deleteExistingSuggestions');
//Route::post('/portal-card/{id}/add-new-suggestions', [PortalCardInputController::class, 'addNewSuggestions'])->name('PortalCard.addNewSuggestions');

