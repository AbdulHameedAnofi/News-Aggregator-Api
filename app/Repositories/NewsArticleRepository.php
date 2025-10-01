<?php

namespace App\Repositories;

use App\Contracts\Repositories\NewsArticleRepositoryInterface;
use App\Models\NewsArticle;
use App\Models\Preference;

class NewsArticleRepository implements NewsArticleRepositoryInterface
{
    public function getArticles(array $data, $session)
    {
        $userPreference = $this->userPreference($session->getId());
        
        $articles = NewsArticle::when(!empty($userPreference['sources']), function ($query) use ($userPreference) {
                            $query->whereIn('source', $userPreference['sources']);
                        })
                        ->when(!empty($userPreference['categories']), function ($query) use ($userPreference) {
                            $query->whereIn('category', $userPreference['categories']);
                        })
                        ->when(!empty($userPreference['authors']), function ($query) use ($userPreference) {
                            $query->whereIn('author', $userPreference['authors']);
                        })
                        ->when(isset($data['search']), function ($query) use ($data) {
                            $query->where("title","like","%". $data['search'] ."%")
                                    ->orWhere("description","like","%". $data['search'] ."%")
                                    ->orWhere("content","like","%". $data['search'] ."%")
                                    ->orWhere("keyword","like","%". $data['search'] ."%")
                                    ->orWhere("news_desk","like","%". $data['search'] ."%")
                                    ->orWhere("headline","like","%". $data['search'] ."%");
                            })
                        ->when(isset($data['date']), function ($query) use ($data){
                            $query->whereDate('published_at', $data['date']);
                        })
                        ->when(isset($data['category']), function ($query) use ($data) {
                            $query->where('category', $data['category']);
                        })
                        ->when(isset($data['source']), function ($query) use ($data) {
                            $query->where('source', $data['source']);
                        })
                    ->get();
                    
        return $articles;
    }

    public function userPreference(string $session_id)
    {
        return Preference::where('session_id', $session_id)->first();
    }

    public function categories()
    {
        return NewsArticle::distinct()->pluck('category');
    }

    public function authors()
    {
        return NewsArticle::distinct()->pluck('author');
    }
}