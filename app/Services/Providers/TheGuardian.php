<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use GuzzleHttp\Client;

class TheGuardian implements NewsProviderInterface
{

    protected $baseurl;
    protected $api_key;
    protected $client;

    public function __construct()
    {
        $this->baseurl = config("datasource.the_guardian.baseurl");
        $this->api_key = config("datasource.the_guardian.api_key");
        $this->client = new Client();
    }
    public function fetch()
    {
        $response = $this->client->get(
            $this->baseurl . 'search',
            [
                "query" => [
                    'api-key' => $this->api_key,
                    'type' => 'article',
                ]
            ]
        );
        return json_decode($response->getBody(), true);        
    }

    public function storeArticles($article)
    {

        [
            'id' => $article['id'],
            'title'=> $article['webTitle'],
            'type' => $article['type'],
            'category' => $article['sectionName'],
            'url' => $article['webUrl'],
            'source' => NewsSourcesEnum::TheGuardian,
            'publishedAt' => $article['webPublicationDate'],
        ];

        
        // "id": "world/live/2025/sep/29/moldova-voters-pro-eu-government-russia-drones-europe-live",
        // "type": "liveblog",
        // "sectionId": "world",
        // "sectionName": "World news",
        // "webPublicationDate": "2025-09-29T08:08:24Z",
        // "webTitle": "Moldova voters choose pro-EU government over Moscow-leaning alliance – Europe live",
        // "webUrl": "https://www.theguardian.com/world/live/2025/sep/29/mol...,
        // "apiUrl": "https://content.guardianapis.com/world/live/2025/sep/29/mo...,
        // "isHosted": false,
        // "pillarId": "pillar/news",
        // "pillarName": "News"
    }
}