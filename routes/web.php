<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeEntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TimeEntryController::class, 'index'])->name('entries.index')->middleware('auth');
Route::get('/report-export', [ExportController::class, 'reportExport'])->name('entries.export')->middleware('auth');
Route::get('/entry/create', [TimeEntryController::class, 'create'])->name('entries.create')->middleware('auth');
Route::post('/entry/store', [TimeEntryController::class, 'store'])->name('entries.store')->middleware('auth');
Route::get('/entry/{timeEntry}', [TimeEntryController::class, 'show'])->name('entries.show')->middleware('auth');
