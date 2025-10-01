<?php

namespace App\Enum;

enum NewsSourcesEnum: string
{
    case NEWSAPI = 'news_api';
    case THEGUARDIAN = 'the_guardian';
    case NEWYORKTIMES = 'new_york_times';

    public static function toArray(): array
    {
        return [
            self::NEWSAPI->value,
            self::THEGUARDIAN->value,
            self::NEWYORKTIMES->value
        ];
    }

    public function label(): string
    {
        return match($this) {
            self::NEWSAPI => 'News API',
            self::THEGUARDIAN => 'The Guardian',
            self::NEWYORKTIMES => 'New York Times',
        };
    }   
}
