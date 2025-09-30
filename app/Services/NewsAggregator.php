<?php

namespace App\Services;

use App\Contracts\NewsProviderInterface;
use App\Models\NewsArticle;
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
            
            try {
                $articles = $provider->fetch();

                foreach ($articles as $article) {
                    DB::table('news_articles')->updateOrInsert(     
                        ['provider_id' => $article['provider_id']],
                        $article,
                    );
                }
            } catch (\Throwable $th) {
                info("Error running insert statement ". $th->getMessage());
            }

        }
    }
}