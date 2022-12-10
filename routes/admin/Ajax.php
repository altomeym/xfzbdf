<?php

use App\Http\Controllers\Admin\AjaxController;
use Illuminate\Support\Facades\Route;

// added by hassan00942 + fiverLikeAddingProduct00942
Route::get('ajax/categorySubGroup', [AjaxController::class, 'category_sub_groups'])
  ->name('ajax.categorySubGroup');

Route::get('ajax/categories', [AjaxController::class, 'categories'])
  ->name('ajax.categories');