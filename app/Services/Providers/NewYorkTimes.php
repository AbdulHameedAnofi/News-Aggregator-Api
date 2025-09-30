<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use App\Models\NewsArticle;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class NewYorkTimes implements NewsProviderInterface
{

    protected $baseurl;
    protected $api_key;
    protected $client;

    public function __construct()
    {
        $this->baseurl = config("datasource.new_york_times.baseurl");
        $this->api_key = config("datasource.new_york_times.api_key");
        $this->client = new Client();
    }
    public function fetch(): array
    {
        $response = $this->client->get(
            $this->baseurl . 'articlesearch.json',
            [
                "query" => [
                    'q' => 'technology',
                    'language' => 'en',
                    'pageSize' => 10,
                    'api-key' => $this->api_key
                ]
            ]
        );
        
        $response = json_decode($response->getBody(), true)['response']['docs'];

        foreach ($response as $article) {
            $articles[] = [
                'provider_id' => $article['_id'],
                'title'=> $article['headline']['main'],
                'description' => $article['abstract'],
                'author' => $article['byline']['original'],
                'headline' => $article['headline']['print_headline'],
                // 'keywords' => $article['keywords'],               //json
                // 'multimedia' => $article['multimedia'],           //json
                'news_desk' => $article['news_desk'],
                'category' => $article['section_name'],
                'snippet' => $article['snippet'],
                'subsection_name' => $article['subsection_name'],
                'url' => $article['web_url'],
                'word_count' => $article['word_count'],
                'source' => NewsSourcesEnum::NEWYORKTIMES,
                'type_of_material' => $article['type_of_material'],
                'provider_source' => $article['source'],
                'published_at' => $article['pub_date'],
            ];
        }

        return $articles;
    }
}