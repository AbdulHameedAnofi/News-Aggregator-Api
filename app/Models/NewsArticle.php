<?php

namespace App\Models;

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
        'urlToImage',
        'type_of_material',
        'provider_source',
        'content',
        'word_count',
        'publishedAt',
    ];

    protected $casts = [
        'keywords' => 'array',
        'multimedia' => 'array',
        'publishedAt' => 'datetime',
    ];
}
