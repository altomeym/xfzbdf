<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductUploadController;
use Illuminate\Support\Facades\Route;

// Bulk upload routes
Route::get('product/upload/downloadCategorySlugs', [ProductUploadController::class, 'downloadCategorySlugs'])->name('product.downloadCategorySlugs');

Route::get('product/upload/downloadTemplate', [ProductUploadController::class, 'downloadTemplate'])->name('product.downloadTemplate');

Route::get('product/upload', [ProductUploadController::class, 'showForm'])->name('product.bulk');

Route::post('product/upload', [ProductUploadController::class, 'upload'])->name('product.upload');

Route::post('product/import', [ProductUploadController::class, 'import'])->name('product.import');

Route::post('product/downloadFailedRows', [ProductUploadController::class, 'downloadFailedRows'])->name('product.downloadFailedRows');

// Product model routes
Route::post('product/massTrash', [ProductController::class, 'massTrash'])->name('product.massTrash');

Route::post('product/massDestroy', [ProductController::class, 'massDestroy'])->name('product.massDestroy');

Route::delete('product/emptyTrash', [ProductController::class, 'emptyTrash'])->name('product.emptyTrash');

Route::delete('product/{product}/trash', [ProductController::class, 'trash'])->name('product.trash'); // product move to trash

Route::get('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');

Route::post('product/store', [ProductController::class, 'store'])->name('product.store')->middleware('ajax');

Route::post('product/{product}/update', [ProductController::class, 'update'])->name('product.update')->middleware('ajax');

Route::get('product/getProducts', [ProductController::class, 'getProducts'])->name('product.getMore');

// added by hassan00942 + taskShopPageUi00942
Route::get('product/getProducts-list', [ProductController::class, 'getProductsList'])->name('product.getMoreList');

Route::resource('product', ProductController::class)->except('store', 'update');

// fiverLikeAddingProduct00942
Route::get('product/update/description-faqs', [ProductController::class, 'update_description_faqs'])->name('product.update_description_faqs');
Route::get('product/update/requirements', [ProductController::class, 'update_requirements'])->name('product.update_requirements');
Route::get('product/update/gallery', [ProductController::class, 'update_gallery'])->name('product.update_gallery');
Route::post('product/update/description-faqs', [ProductController::class, 'update_description_faqs'])->name('product.update_description_faqs');;
Route::post('product/update/requirements', [ProductController::class, 'update_requirements']);
Route::post('product/update/gallery', [ProductController::class, 'update_gallery']);

