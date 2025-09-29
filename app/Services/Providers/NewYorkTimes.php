<?php

namespace App\Services\Providers;

use App\Contracts\NewsProviderInterface;
use App\Enum\NewsSourcesEnum;
use GuzzleHttp\Client;

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
        return json_decode($response->getBody(), true);        
    }

    public function storeArticles($article)
    {

        [
            'id' => $article['_id'],
            'title'=> $article['headline']['main'],
            'description' => $article['abstract'],
            'author' => $article['byline']['original'],
            'headline' => $article['headline']['print_headline'],
            'keywords' => $article['keywords'],               //json
            'multimedia' => $article['multimedia'],           //json
            'news_desk' => $article['news_desk'],
            'category' => $article['section_name'],
            'snippet' => $article['snippet'],
            'subsection_name' => $article['subsection_name'],
            'url' => $article['web_url'],
            'word_count' => $article['word_count'],
            'source' => NewsSourcesEnum::NewYorkTimes,
            'type_of_material' => $article['type_of_material'],
            'provider_source' => $article['source'],
            'publishedAt' => $article['pub_date'],
        ];

        // "abstract": "Mr. Musk spent the summer at his artificial intelligence...,
        // "byline": {
        //   "original": "By Cade Metz, Kate Conger and Ryan Mac"
        // },
        // "document_type": "article",
        // "headline": {
        //   "main": "Since Leaving Washington, Elon Musk Has Been All In on His A.I. Company",
        //   "kicker": "",
        //   "print_headline": "Musk All In At A.I. Firm After Exit From D.C."
        // },
        // "_id": "nyt://article/3fc00f59-ffd3-5b3d-9c51-accda487eb5b",
        // "keywords": [
        //   {
        //     "name": "Person",
        //     "value": "Musk, Elon",
        //     "rank": 1
        //   } ...,
        // ],
        // "multimedia": {
        //   "caption": "Since leaving Washington in June, Elon ...,
        // "news_desk": "Business",
        // "print_page": "1",
        // "print_section": "B",
        // "pub_date": "2025-09-18T21:44:46Z",
        // "section_name": "Technology",
        // "snippet": "Mr. Musk spent the summer at his artificial...,
        // "source": "The New York Times",
        // "subsection_name": "",
        // "type_of_material": "News",
        // "uri": "nyt://article/3fc00f59-ffd3-5b3d-9c51-accda487eb5b",
        // "web_url": "https://www.nytimes.com/2025/09/18/technology/elon-musk-artificial-intelligence-xai.html",
        // "word_count": 1681

    }
}