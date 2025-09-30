<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use App\Models\NewsArticle;
use GuzzleHttp\Client;

class NewsAPI implements NewsProviderInterface
{

    protected $baseurl;
    protected $api_key;
    protected $client;

    public function __construct()
    {
        $this->baseurl = config("datasource.news_api.baseurl");
        $this->api_key = config("datasource.news_api.api_key");
        $this->client = new Client();
    }

    public function fetch(): array
    {
        $response = $this->client->get(
            $this->baseurl . 'everything',
            [
                'headers' => [
                    "X-Api-Key" => $this->api_key
                ],
                "query" => [
                    'q' => 'articles',
                    'language' => 'en',
                    'pageSize' => 10,
                ]
            ]
        );

        $response = json_decode($response->getBody(), true)['articles'];

        foreach ($response as $article) {

            $articles[] = [
                'author' => $article['author'],
                'provider_id' => $article['url'],
                'title' => $article['title'],
                'description' => $article['description'],
                'category' => $article['source']['name'],
                'url' => $article['url'],
                'url_to_image' => $article['urlToImage'],
                'source' => NewsSourcesEnum::NEWSAPI,
                'published_at' => $article['publishedAt'],
                'content' => $article['content']
            ];
        }

        return $articles;
    }
}