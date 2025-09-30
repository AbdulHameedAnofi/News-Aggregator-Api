<?php

use App\Enum\NewsSourcesEnum;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/newapi', [ArticlesController::class, 'retrieveArticles']);

Route::post('/user/preference', [UserController::class,'setUserPreference']);

Route::get('/categories', [ArticlesController::class, 'categories']);
Route::get('/authors', [ArticlesController::class, 'authors']);

Route::get('/articles', [ArticlesController::class,'articles']);
