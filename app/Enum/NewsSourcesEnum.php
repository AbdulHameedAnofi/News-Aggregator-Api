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
}
