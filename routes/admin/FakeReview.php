<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FakeReviewController;

Route::get('reviews/add_fake', [FakeReviewController::class, 'addfake'])->name('reviews.add_fake');
Route::post('reviews/add_fake_reivews', [FakeReviewController::class, 'add_fake_reivews'])->name('reviews.add_fake_reivews');
Route::get('reviews/add_csv', [FakeReviewController::class, 'add_csv'])->name('reviews.add_csv');
Route::post('reviews/add_csv_reivews', [FakeReviewController::class, 'add_csv_reivews'])->name('reviews.add_csv_reivews');
