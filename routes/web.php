<?php

use Illuminate\Support\Facades\Route;

// SPA Fallback - All routes akan di-handle oleh Vue Router
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
