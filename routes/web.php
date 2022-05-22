<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TrashNoteController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/notes', NoteController::class)->middleware(['auth']);
Route::get('/trashed', [TrashNoteController::class, 'index'])->middleware('auth')->name('trashed.index');
Route::get('/trashed/{note}', [TrashNoteController::class, 'show'])->withTrashed()->middleware('auth')->name('trashed.show');

Route::put('/trashed/{note}', [TrashNoteController::class, 'update'])->withTrashed()->middleware('auth')->name('trashed.update');
Route::delete('/trashed/{note}', [TrashNoteController::class, 'destroy'])->withTrashed()->middleware('auth')->name('trashed.destroy');



Route::get('/notes/javascript', [NoteController::class, 'index'])->name('javascript');

Route::get('/notes/css', function () {
    //
})->name('css');

Route::get('/notes/html', function () {
    //
})->name('html');

// Route::get('/notes',);

// Route::get('/notes/{note}',);

// Route::get('/notes/create',);

// Route::post('/notes',);

//edit

//update
//destroy


require __DIR__ . '/auth.php';
