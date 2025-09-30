<?php



return [
    "new_york_times" => [
        "baseurl" => "https://api.nytimes.com/svc/search/v2/",
        "api_key" => env('NEW_YORK_TIMES_API_KEY', ''),
    ],

    "the_guardian" => [
        "baseurl" => "https://content.guardianapis.com/",
        "api_key" => env('THE_GUARDIAN_API_KEY', ''),
    ],

    "news_api" => [
        "baseurl" => "https://newsapi.org/v2/",
        "api_key" => env('NEWSAPI_API_KEY', ''),
    ],
];