<?php

use App\Http\Controllers\Cars;
use App\Http\Controllers\Posts;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/clear', function () {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
//     Artisan::call('route:clear');
//     return "Сброс кэша выполнен!";
// });

// Route::get('/symlink', function () {
//     $targetFolder = $_SERVER['DOCUMENT_ROOT'].
//                         DIRECTORY_SEPARATOR . 'storage' .
//                         DIRECTORY_SEPARATOR . 'app' .
//                         DIRECTORY_SEPARATOR . 'public'.
//                         DIRECTORY_SEPARATOR . 'photos';
 
//     $linkFolder = $_SERVER['DOCUMENT_ROOT'].
//                     DIRECTORY_SEPARATOR . 'public' .
//                     DIRECTORY_SEPARATOR . 'photos';
 
//     symlink($targetFolder, $linkFolder);
 
//     return "Создание символьныой ссылки завершено!";
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/start', function () {
    return Inertia::render('Start');
})->name('start');

Route::get('/db', function () {
    return Inertia::render('DB');
})->name('db');

Route::get('/postoyanniki', function () {
    return Inertia::render('Dashboard');
})->name('postoyanniki');
Route::get('/acessory', function () {
    return Inertia::render('Acessory');
})->name('acessory');
Route::get('/statistics', function () {
    return Inertia::render('Statistics');
})->name('statistics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
