<?php

use App\Services\NewsAggregator;
use App\Services\Providers\NewsAPI;
use App\Services\Providers\NewYorkTimes;
use App\Services\Providers\TheGuardian;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $aggregator = new NewsAggregator([
        new NewsAPI(),
        new TheGuardian(),
        new NewYorkTimes()
    ]);
    $aggregator->fetchArticlesAndSave();
})
->name('fetch:articles')
->everyMinute();
