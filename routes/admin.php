<?php

use Illuminate\Support\Facades\Route;
// سنضيف المسارات بعد نقل كنترولر الإدارة إلى الباكيج
Route::middleware(['web','auth', \App\Http\Middleware\superadminMiddleware::class])
    ->prefix('superadmin')->name('superadmin.')->group(function () {
        // placeholder
    });
