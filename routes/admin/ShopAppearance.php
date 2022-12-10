<?php

use App\Http\Controllers\Admin\ShopAppearanceController;
use Illuminate\Support\Facades\Route;

// Shop Appearance
Route::get('shop-appearance', [ShopAppearanceController::class, 'index'])->name('shop-appearance');

Route::post('shop-appearance/save', [ShopAppearanceController::class, 'save'])->name('shop-appearance.save');
Route::delete('shop-appearance/delete', [ShopAppearanceController::class, 'delete'])->name('shop-appearance.delete');
// Route::post('shop-appearance/popular-links/save', [ShopAppearanceController::class, 'popular_links_save'])->name('shop-appearance.slider-links.save');
// Route::post('shop-appearance/slider-links/save', [ShopAppearanceController::class, 'slider_links_save'])->name('shop-appearance.slider-links.save');
// Route::get('shop-appearance/save', [ShopAppearanceController::class, 'save'])->name('shop-appearance.save');
