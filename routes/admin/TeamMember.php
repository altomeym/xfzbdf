<?php

use App\Http\Controllers\Admin\TeamPageSettingController;
use App\Http\Controllers\Admin\TeamMemberController;
use Illuminate\Support\Facades\Route;

// team
Route::get('team-page-setting', [TeamPageSettingController::class, 'index'])->name('team-page-setting.index');

Route::put('team-page-setting/{id}', [TeamPageSettingController::class, 'update'])->name('team-page-setting.update');
// Route::resource('team-page-setting', TeamPageSettingController::class)->only('update');

// team members
Route::post('team-member/massTrash', [TeamMemberController::class, 'massTrash'])->name('team-member.massTrash')->middleware('demoCheck');

Route::post('team-member/massDestroy', [TeamMemberontroller::class, 'massDestroy'])->name('team-member.massDestroy')->middleware('demoCheck');

Route::delete('team-member/emptyTrash', [TeamMemberController::class, 'emptyTrash'])->name('team-member.emptyTrash');

Route::delete('team-member/{id}/trash', [TeamMemberController::class, 'trash'])->name('team-member.trash'); // page move to trash

Route::get('team-member/{team-member}/restore', [TeamMemberController::class, 'restore'])->name('team-member.restore');

Route::resource('team-member', TeamMemberController::class)->except('show');
