<?php

use Illuminate\Support\Facades\Route;

Route::get('/newapi', [\App\Http\Controllers\ArticlesController::class, 'retrieveArticles']);