<?php

use App\Http\Controllers\AgreementController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', [AgreementController::class, 'index'])
    ->middleware(['auth'])
    ->name('agreements.index');

Route::get('agreements/show/{slug}', [AgreementController::class, 'show'])
    ->middleware(['auth'])
    ->name('agreements.show');

Route::get('agreements/create', [AgreementController::class, 'create'])
    ->middleware(['auth'])
    ->name('agreements.create');

Route::get('/admin/reports', function () {
    return view('admin.reports.index');
})->middleware(AdminMiddleware::class)->name('admin.reports.index');

require __DIR__.'/auth.php';
