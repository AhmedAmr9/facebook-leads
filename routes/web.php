<?php

use App\Http\Controllers\FileController;

Route::get('/upload', [FileController::class, 'index']);
Route::post('/upload', [FileController::class, 'upload'])->name('upload');

Route::get('/{any}', function () {
    return redirect()->route('home');
})->where('any', '.*');