<?php

use App\AppPlugin\AppPuzzle\AppPuzzleController;
use App\AppPlugin\AppPuzzle\AppPuzzleTreeAppCore;
use Illuminate\Support\Facades\Route;


Route::get('/puzzle/Config/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Config.IndexModel');
Route::get('/puzzle/data/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Data.IndexModel');
Route::get('/puzzle/leads/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Leads.IndexModel');
Route::get('/puzzle/model/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Model.IndexModel');
Route::get('/puzzle/product/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Product.IndexModel');
Route::get('/puzzle/Crm/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Crm.IndexModel');
Route::get('/puzzle/crmService/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.crmService.IndexModel');
Route::get('/puzzle/AppCore/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.AppCore.IndexModel');
Route::get('/puzzle/Periodicals/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Periodicals.IndexModel');
Route::get('/puzzle/Dictionary/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Dictionary.IndexModel');
Route::get('/puzzle/Tools/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Tools.IndexModel');
Route::get('/puzzle/Client/', [AppPuzzleController::class, 'IndexPuzzle'])->name('AppPuzzle.Client.IndexModel');

Route::get('/puzzle/Client/Import/{model}', [AppPuzzleController::class, 'ImportClientData'])->name('AppPuzzle.ImportClientData');
Route::get('/puzzle/Client/Remove/{model}', [AppPuzzleController::class, 'RemoveClientData'])->name('AppPuzzle.RemoveClientData');
Route::get('/puzzle/Client/Export/{model}', [AppPuzzleController::class, 'ExportClientData'])->name('AppPuzzle.ExportClientData');
Route::get('/puzzle/Client/ExportDB/{model}', [AppPuzzleController::class, 'exportDbBackUp'])->name('AppPuzzle.exportDbBackUp');

Route::get('/AppPuzzle/Copy/{model}', [AppPuzzleController::class, 'CopyModel'])->name('AppPuzzle.Export');
Route::get('/AppPuzzle/Import/{model}', [AppPuzzleController::class, 'ImportModel'])->name('AppPuzzle.Import');
Route::get('/AppPuzzle/Remove/{model}', [AppPuzzleController::class, 'RemoveModel'])->name('AppPuzzle.Remove');
Route::get('/AppPuzzle/CoreFiles', [AppPuzzleTreeAppCore::class, 'ExportCoreFiles'])->name('AppPuzzle.CoreFiles');
Route::get('/AppPuzzle/AssetsFiles', [AppPuzzleTreeAppCore::class, 'ExportAssetsFiles'])->name('AppPuzzle.AssetsFiles');
Route::get('/AppPuzzle/AssetsCssFiles', [AppPuzzleTreeAppCore::class, 'ExportAssetsCssFiles'])->name('AppPuzzle.AssetsCssFiles');
Route::get('/AppPuzzle/Info/{model}',[AppPuzzleController::class,'InfoModel'])->name('AppPuzzle.InfoModel');




