<?php

namespace App\Enum;

enum NewsSourcesEnum: string
{
    case NewsAPI = 'NewsAPI';
    case TheGuardian = 'The Guardian';
    case NewYorkTimes = 'New York Times';

    public static function all(): array
    {
        return [
            self::NewsAPI->value,
            self::TheGuardian->value,
            self::NewYorkTimes->value
        ];
    }
}
