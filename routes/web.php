<?php

use App\Http\Controllers\Adm\RoleController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//
//    return view('welcome',);
//});

Auth::routes();

    Route::resource('/roles', RoleController::class);

    // In routes/web.php
//    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');



Route::get('/contactt', [TestimonialController::class, 'index'])->name('contactt.index');
Route::get('/', [HomeController::class, 'index'])->name('/');
    Route::post('/contact', [TestimonialController::class, 'store'])->name('contact.store');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/search', [UserController::class, 'index'])->name('users.search');

    Route::get('/contact', [TestimonialController::class, 'index1'])->name('contact.index1');
    Route::get('/contact/search', [TestimonialController::class, 'index1'])->name('index1');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
// Страница списка пользователей
Route::get('/chat', [ChatController::class, 'index'])->middleware('auth')->name('chat');

// Страница чата с выбранным пользователем
Route::get('/chat/{receiverId}', [ChatController::class, 'showChat'])->middleware('auth');

// Отправка сообщений
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->middleware('auth');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
