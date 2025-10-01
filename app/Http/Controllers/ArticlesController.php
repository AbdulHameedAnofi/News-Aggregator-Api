<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\NewsArticleRepositoryInterface;
use App\Http\Requests\GetArticlesRequest;
use App\Http\Resources\NewsArticleResource;
use App\Services\Providers\NewYorkTimes;
use Illuminate\Support\Facades\Cache;

class ArticlesController extends Controller
{
    public function __construct(
        protected NewsArticleRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function articles(GetArticlesRequest $request)
    {
        $articles = $this->repository->getArticles($request->toArray(), $request->session());

        return $this->success('Articles list', NewsArticleResource::collection($articles));
    }

    public function categories()
    {
        $categories = Cache::remember('categories', 3600, function () {
            return $this->repository->categories();
        });

        return $this->success('Categories list', $categories);
    }

    public function authors()
    {
        $authors = Cache::remember('authors', 3600, function () {
            return $this->repository->authors();
        });

        return $this->success('Authors list', $authors);
    }
}
