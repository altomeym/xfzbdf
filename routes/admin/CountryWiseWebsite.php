<?php

use App\Http\Controllers\Admin\CountryWiseWebsiteController;
use Illuminate\Support\Facades\Route;

// country_wise_websites
Route::get('country-wise-website', [CountryWiseWebsiteController::class, 'index'])->name('country-wise-website');

Route::get('country-wise-website/create', [CountryWiseWebsiteController::class, 'create'])->name('country-wise-website.create');

Route::post('country-wise-website/store', [CountryWiseWebsiteController::class, 'store'])->name('country-wise-website.store');

Route::get('country-wise-website/{country_wise_website}/edit', [CountryWiseWebsiteController::class, 'edit'])->name('country-wise-website.edit');

Route::put('country-wise-website/update/{country_wise_website}', [CountryWiseWebsiteController::class, 'update'])->name('country-wise-website.update');

Route::delete('country-wise-website/destroy/{country_wise_website}', [CountryWiseWebsiteController::class, 'destroy'])->name('country-wise-website.destroy');