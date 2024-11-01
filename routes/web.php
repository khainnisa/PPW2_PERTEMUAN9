<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about', [
        'name' => 'Antony Santos',
        'email' => 'I8E9x@example.com'
    ]);
});

Route::get('/books', function () {
    return view('books', [
        'books' => [
            'The Great Gatsby',
            '1984',
            'To Kill a Mockingbird',
            'Pride and Prejudice',
            'Moby-Dick'
        ]
    ]);
});

Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('create');
Route::post('/buku', [BukuController::class, 'store'])->name('store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('destroy');
// mengedit buku
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('update');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store.user');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });
   