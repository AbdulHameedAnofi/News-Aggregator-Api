<?php

namespace App\Models;

use App\Enum\NewsSourcesEnum;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    //
    protected $fillable = [
        'id',
        'provider_id',
        'title',
        'author',
        'headline',
        'keywords',
        'multimedia',
        'news_desk',
        'type',
        'source',
        'category',
        'snippet',
        'subsection_name',
        'description',
        'url',
        'url_to_image',
        'type_of_material',
        'provider_source',
        'content',
        'word_count',
        'published_at',
    ];

    protected $casts = [
        'source' => NewsSourcesEnum::class,
        'keywords' => 'array',
        'multimedia' => 'array',
        'published_at' => 'datetime',
    ];
}
