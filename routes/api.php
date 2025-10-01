<?php

use App\Enum\NewsSourcesEnum;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/user/preference', [UserController::class,'setUserPreference']);

Route::get('/categories', [ArticleController::class, 'categories']);
Route::get('/authors', [ArticleController::class, 'authors']);
Route::get('/sources', [ArticleController::class,'sources']);

Route::get('/articles', [ArticleController::class,'articles']);
