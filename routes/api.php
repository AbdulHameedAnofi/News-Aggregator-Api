<?php

use App\Enum\NewsSourcesEnum;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/newapi', [ArticlesController::class, 'retrieveArticles']);

Route::get('/user/preference', [UserController::class,'setUserPreference']);

Route::get('/categories', [ArticlesController::class, 'categories']);
Route::get('/authors', [ArticlesController::class, 'authors']);
// Route::get('/sources', NewsSourcesEnum::all());

Route::get('/articles-by-preference', [ArticlesController::class, 'getByPreference']);
Route::get('/articles-by-filter', [ArticlesController::class,'getByFilter']);
Route::get('/article-by-search', [ArticlesController::class,'getBySearchQuery']);