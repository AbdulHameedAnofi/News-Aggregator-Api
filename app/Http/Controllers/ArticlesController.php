<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Services\Providers\NewYorkTimes;
use App\Services\Providers\TheGuardian;
use App\Services\Providers\NewsAPI;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function retrieveArticles(Request $request)
    {
        $articles = new TheGuardian();

        $data = $articles->fetch();
        
        return $data;
    }

    public function getArticles(Request $request)
    {
        $request->validate([
            'search' => 'string|nullable',
            'filter' => [
                    'source' => 'in:NewsAPI,The Guardian,New York Times',
                    'category' => 'string|nullable',
                    'date' => 'date|nullable'
                ]
        ]);

        $articles = NewsArticle::all();

        return $this->success('Articles list', $articles);
    }

    public function getBySearchQuery(Request $request)
    {
        $articles = NewsArticle::where("title","like","%". $request->search ."%")
                    ->orWhere("description","like","%". $request->search ."%")
                    ->orWhere("content","like","%". $request->search ."%")
                    ->get();

        return $this->success('Articles list', $articles);
    }

    public function getByFilter(Request $filter)
    {
        $articles = NewsArticle::when(isset($filter['date']), function ($query) use ($filter) {
                                        $query->whereDate('publishedAt', $filter['date']);
                                    })
                                    ->when(isset($filter['category']), function ($query) use ($filter) {
                                        $query->where('category', $filter['category']);
                                    })
                                    ->when(isset($filter['source']), function ($query) use ($filter) {
                                        $query->where('source', $filter['source']);
                                    })
                                ->get();

        return $this->success('Articles list', $articles);
    }

    public function getByPreference(Request $request)
    {
        dd($request->session()->all());
        $articles = NewsArticle::when(isset($request->preference), function ($query) use ($request) {
                                    $query->whereIn('category', $request->session()->get('categories', []))
                                          ->whereIn('source', $request->session()->get('sources', []))
                                          ->whereIn('author', $request->session()->get('authors', []));
                                    })
                                ->get();

        return $this->success('Articles list', $articles);
    }

    public function categories()
    {
        $categories = Cache::remember('categories', 3600, function () {
            return NewsArticle::distinct()->pluck('category');
        });

        return $this->success('Categories list', $categories);
    }

    public function authors()
    {
        $authors = Cache::remember('authors', 3600, function () {
            return NewsArticle::distinct()->pluck('author');
        });

        return $this->success('Authors list', $authors);
    }
}
