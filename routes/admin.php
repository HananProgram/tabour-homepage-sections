<?php

use Illuminate\Support\Facades\Route;
use Tabour\Homepage\Http\Controllers\Admin\SectionController;

Route::middleware(['web', 'auth', \App\Http\Middleware\SuperAdminMiddleware::class])
    ->prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/homepage-sections', [SectionController::class, 'index'])->name('homepage-sections.index');
        Route::get('/homepage-sections/create', [SectionController::class, 'create'])->name('homepage-sections.create');
        Route::post('/homepage-sections', [SectionController::class, 'store'])->name('homepage-sections.store');
        Route::get('/homepage-sections/{section}/edit', [SectionController::class, 'edit'])->name('homepage-sections.edit');
        Route::put('/homepage-sections/{section}', [SectionController::class, 'update'])->name('homepage-sections.update');
        Route::delete('/homepage-sections/{section}', [SectionController::class, 'destroy'])->name('homepage-sections.destroy');
        Route::post('homepage-sections/reorder', [SectionController::class, 'reorder'])->name('homepage-sections.reorder');
        Route::delete('/homepage-sections/{section}/features/{featureIndex}', [SectionController::class, 'destroyFeature'])->name('homepage-sections.features.destroy');
    });
