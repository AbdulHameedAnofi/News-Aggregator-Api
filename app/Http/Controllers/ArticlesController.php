<?php

namespace App\Http\Controllers;

use App\Services\Providers\NewYorkTimes;
use App\Services\Providers\TheGuardian;
use App\Services\Providers\NewsAPI;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function articlesSearch(Request $request)
    {
        $articles = new NewsAPI();

        $data = $articles->fetch();
        
        return $data;
    }

    public function articleFilter(Request $request)
    {
        $articles = new NewYorkTimes();
        // $articles = new TheGuardian();
        return $articles->fetch();
    }

    
}
