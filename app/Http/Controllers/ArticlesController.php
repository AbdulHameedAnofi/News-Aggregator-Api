<?php

namespace App\Http\Controllers;

use App\Services\Providers\NewYorkTimes;
use App\Services\Providers\TheGuardian;
use App\Services\Providers\NewsAPI;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function retrieveArticles(Request $request)
    {
        $articles = new NewYorkTimes();

        return $articles->fetch();
    }
}
