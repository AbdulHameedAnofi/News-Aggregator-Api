<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use App\Models\NewsArticle;
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
    public function fetch(): array
    {
        $response = $this->client->get(
            $this->baseurl . 'search',
            [
                "query" => [
                    'to-date' => date('Y-m-d', strtotime('-1 week')),
                    'from-date' => date('Y-m-d', strtotime('')),
                    'api-key' => $this->api_key,
                    // 'page-size' => 10,
                    'type' => 'article',
                ]
            ]
        );
        
        return json_decode($response->getBody(), true)['response']['results'];
    }

    public function map(array $response): array {
        
        foreach ($response as $article) {
            $articles[] = [
                'provider_id' => $article['id'],
                'title'=> $article['webTitle'],
                'type' => $article['type'],
                'category' => $article['sectionName'],
                'url' => $article['webUrl'],
                'source' => NewsSourcesEnum::THEGUARDIAN,
                'published_at' => $article['webPublicationDate'],
                'pillarId' => $article['pillarId'],
                'pillarName' => $article['pillarName'],
            ];
        }

        return $articles;
    }
}