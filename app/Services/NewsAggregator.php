<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class NewsAggregator
{
    protected $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function fetchArticlesAndSave()
    {
        foreach ($this->providers as $provider) {
            
            $articles = $provider->fetch();

            foreach ($articles as $article) {
                DB::table('news_articles')->updateOrInsert(
                    ['title' => $article['title']],
                    $article
                );
            } 
        }
    }
}