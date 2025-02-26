<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\MarkdownHelper;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $excerptLength = Str::length($this->name) < 40 ? 110 : 70;
        return [
            'id' => $this->id,
            'name' => Str::limit($this->name, 60, '...'),
            'slug' => $this->slug,
            'keywords' => $this->tags->pluck('name')->implode(', '),
            'thumbnail' =>  $this->getFirstMediaUrl('thumbnail') ?? null,
            'image' =>  $this->getFirstMediaUrl('thumbnail') ?? null,
            'content' => MarkdownHelper::convertToHtml($this->content),
            'excerpt' => Str::limit($this->content, $excerptLength, '...'),
            'keywords' => $this->tags->pluck('name')->implode(', '),
            'author' => new UserResource($this->author),
            'category' => new CategoryResource($this->category),
            'is_published' => $this->is_published,
            'time_to_read' => $this->time_to_read,
            'tags' => TagResource::collection($this->tags),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
