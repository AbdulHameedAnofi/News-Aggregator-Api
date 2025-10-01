<?php

namespace App\Http\Resources;

use App\Enum\NewsSourcesEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = match ($this->source) {
            NewsSourcesEnum::THEGUARDIAN => [
                'provider_id' => $this->provider_id,
                'title'=> $this->title,
                'type' => $this->type,
                'category' => $this->category,
                'url' => $this->url,
                'source' => $this->source,
                'published_at' => $this->published_at,
                'pillarId' => $this->pillarId,
                'pillarName' => $this->pillarName,
            ],
            NewsSourcesEnum::NEWYORKTIMES => [
                'provider_id' => $this->provider_id,
                'title'=> $this->title,
                'description' => $this->description,
                'author' => $this->author,
                'headline' => $this->headline,
                'news_desk' => $this->news_desk,
                'category' => $this->category,
                'snippet' => $this->snippet,
                'subsection_name' => $this->subsection_name,
                'url' => $this->url,
                'word_count' => $this->word_count,
                'source' => $this->source,
                'type_of_material' => $this->type_of_material,
                'provider_source' => $this->provider_source,
                'published_at' => $this->published_at,
            ],
            NewsSourcesEnum::NEWSAPI => [
                'author' => $this->author,
                'provider_id' => $this->provider_id,
                'title' => $this->title,
                'description' => $this->description,
                'category' => $this->category,
                'url' => $this->url,
                'url_to_image' => $this->url_to_image,
                'source' => $this->source,
                'published_at' => $this->published_at,
                'content' => $this->content,
            ]
        };

        return $data;
    }
}
