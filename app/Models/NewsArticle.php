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
        'pillarId',
        'pillarName',
        'published_at',
    ];

    protected $casts = [
        'source' => NewsSourcesEnum::class,
        'published_at' => 'datetime',
    ];
}
