<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/posts', [PostController::class, 'index']);