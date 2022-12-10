<?php

use App\Http\Controllers\Admin\GuideLeadController;
use Illuminate\Support\Facades\Route;

Route::post('guide-lead/massDestroy', [GuideLeadController::class, 'massDestroy'])->name('guide-lead.massDestroy')->middleware('demoCheck');
Route::resource('guide-lead', GuideLeadController::class)->except('show');
