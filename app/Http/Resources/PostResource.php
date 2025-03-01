<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Extension\Attributes\AttributesExtension;

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
        
        if ($request->has('simple')) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => $this->slug,
                'thumbnail' => $this->getFirstMediaUrl('thumbnail'),
                'excerpt' => Str::limit(strip_tags($this->convertMarkdownToHtml($this->content)), $excerptLength, '...'),
                'is_published' => $this->is_published,
                'time_to_read' => $this->time_to_read,
                'views_count' => $this->views_count,
                'is_featured' => $this->is_featured,
                'published_at' => $this->published_at,
                'created_at' => $this->created_at->diffForHumans(),
                'updated_at' => $this->updated_at->diffForHumans(),
            ];
        }

        // Generate fallback image URL using UI Avatar or similar service
        $fallbackImage = 'https://ui-avatars.com/api/?' . http_build_query([
            'name' => $this->name,
            'background' => 'random',
            'size' => '800',
            'format' => 'png',
            'bold' => 'true'
        ]);
        return [
            'id' => $this->id,
            'name' => Str::limit($this->name, 60, '...'),
            'meta_description' => $this->meta_description,
            'slug' => $this->slug,
            'tags' => $this->tags->pluck('name')->implode(', '),
            'thumbnail' =>  $this->getFirstMediaUrl('thumbnail') ?: $fallbackImage,
            'image' =>  $this->getFirstMediaUrl('thumbnail') ?: $fallbackImage,
            'content' => $this->convertMarkdownToHtml($this->content),
            'excerpt' => Str::limit(strip_tags($this->convertMarkdownToHtml($this->content)), $excerptLength, '...'),
            'keywords' => $this->keywords,
            'author' => [
                'name' => $this->author->name,
                'avatar' => $this->author->avatar ?? "https://ui-avatars.com/api/?name=" . urlencode($this->author->name),
                'bio' => $this->author->bio,
                'social_links' => $this->author->social_links,
            ],
            'category' => new CategoryResource($this->category),
            'is_published' => $this->is_published,
            'time_to_read' => $this->time_to_read,
            'views_count' => $this->views_count,
            'is_featured' => $this->is_featured,
            'published_at' => $this->published_at,
            'tags' => TagResource::collection($this->tags),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }

    protected function convertMarkdownToHtml($markdown)
    {
        if (is_array($markdown)) {
            $content = $markdown[app()->getLocale()] ?? '';
        } else {
            $content = $markdown;
        }

        if (empty($content)) {
            return '';
        }

        $config = [
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 100,
            'renderer' => [
                'soft_break' => "<br>\n",
            ],
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new AttributesExtension());

        $converter = new MarkdownConverter($environment);
        $html = $converter->convert($content)->getContent();

        return $html;
    }
}
