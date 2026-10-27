<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('biodata.index'));

Route::resource('biodata', BiodataController::class)
    ->parameters(['biodata' => 'biodata']);

Route::post('biodata/{biodata}/item/{tipe}', [ItemController::class, 'store'])
    ->name('item.store');
Route::delete('item/{tipe}/{id}', [ItemController::class, 'destroy'])
    ->name('item.destroy');
