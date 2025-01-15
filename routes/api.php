<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\authorsController;
use App\Http\Controllers\Api\booksController;
use App\Http\Controllers\Api\Auth\userController;

//AUTHORS
Route::get('/authors',[authorsController::class, 'index']);
Route::post('/authors',[authorsController::class, 'store']);
Route::get('/authors/{id}',[authorsController::class, 'show']);
Route::delete('/authors/{id}',[authorsController::class, 'destroy']);
Route::put('/authors/{id}',[authorsController::class, 'update']);
//BOOKS
Route::get('/books',[booksController::class, 'index']);
Route::post('/books',[booksController::class, 'store']);
Route::get('/books/{id}',[booksController::class, 'show']);
Route::delete('/books/{id}',[booksController::class, 'destroy']);
Route::put('/books/{id}',[booksController::class, 'update']);
//USER
Route::post('/auth/register', [userController::class, 'register']);
Route::post('/auth/login', [userController::class, 'login']);

