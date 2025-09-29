<?php

namespace App\Enum;

enum NewsSourcesEnum: string
{
    case NewsAPI = 'news-api';
    case TheGuardian = 'the-guardian';
    case NewYorkTimes = 'new-york-times';

    public static function all(): array
    {
        return [
            self::NewsAPI->value,
            self::TheGuardian->value,
            self::NewYorkTimes->value
        ];
    }
}
