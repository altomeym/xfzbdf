<?php

use App\Http\Controllers\Admin\AmongMyBrandController;
use Illuminate\Support\Facades\Route;

Route::delete('among-my-brand/{among-my-brand}/trash', [AmongMyBrandController::class, 'trash'])->name('among-my-brand.trash');

Route::post('among-my-brand/massTrash', [AmongMyBrandController::class, 'massTrash'])->name('among-my-brand.massTrash')->middleware('demoCheck');

Route::post('among-my-brand/massDestroy', [AmongMyBrandController::class, 'massDestroy'])->name('among-my-brand.massDestroy')->middleware('demoCheck');

Route::delete('among-my-brand/emptyTrash', [AmongMyBrandController::class, 'emptyTrash'])->name('among-my-brand.emptyTrash');

Route::get('among-my-brand/{among-my-brand}/restore', [AmongMyBrandController::class, 'restore'])->name('among-my-brand.restore');

Route::resource('among-my-brand', AmongMyBrandController::class);
