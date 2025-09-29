<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use GuzzleHttp\Client;

class NewsAPI implements NewsProviderInterface
{

    protected $baseurl;
    protected $api_key;
    protected $client;

    public function __construct()
    {
        $this->baseurl = config("datasource.newsapi.baseurl");
        $this->api_key = config("datasource.newsapi.api_key");
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
        return json_decode($response->getBody(), true);
    }

    public function storeArticles($response)
    {

        [
            'author' => $response['author'],
            'title' => $response['title'],
            'description' => $response['description'],
            'category' => $response['category'],
            'url' => $response['url'],
            'urlToImage' => $response['urlToImage'],
            'source' => NewsSourcesEnum::NewsAPI,
            'provider_source' => $response['source'],       //json
            'publishedAt' => $response['publishedAt'],
            'content' => $response['content']
        ];
    // "source": {
    //     "id": "the-verge",
    //     "name": "The Verge"
    //   },
    //   "author": "Mia Sato",
    //   "title": "Reddit is testing a way to read articles without leaving the app",
    //   "description": "As AI tools gobble up news publishers’...,
    //   "url": "https://www.theverge.com/news/775722/reddit-news-publishers-beta-articles-analytics",
    //   "urlToImage": "https://platform.theverge.com/wp-content/uploads/sites/2/2025/08/STK115_Reddit...,
    //   "publishedAt": "2025-09-10T16:52:26Z",
    //   "content": "\u003Cul\u003E\u003Cli\u003E\u003C/li\u003E\u003Cli\u003E\u003C/li\u003...
    }
}