<?php

use App\Http\Controllers\AnnouncementController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () { return view('index'); });
Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
Route::get('/edit-announcement', [AnnouncementController::class, 'edit'])->name('edit-announcement');
Route::patch('/update-announcement', [AnnouncementController::class, 'update'])->name('update-announcement');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
