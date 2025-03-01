<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Collection;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model implements HasMedia, Feedable
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SoftDeletes, InteractsWithMedia, HasTags;

    const FEED_PAGE_SIZE = 30;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'author_id',
        'category_id',
        'is_published',
        'time_to_read',
        'keywords',
        'published_at',
        'views_count',
        'is_featured',
        'meta_description'
    ];

    public $translatable = ['name', 'slug', 'content', 'keywords', 'meta_description'];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
        'content' => 'array',
        'is_published' => 'boolean',
        'keywords' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'time_to_read' => 'integer',
        'views_count' => 'integer',
        'meta_description' => 'array'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->name)
            ->summary($this->excerpt())
            ->updated($this->updated_at)
            ->link($this->url())
            ->authorName($this->author->name);
    }

    public static function getFeedItems(): Collection
    {
        return self::published()
            ->recent()
            ->paginate(self::FEED_PAGE_SIZE)
            ->getCollection();
    }



    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function excerpt(int $limit = 100): string
    // {
    //     return Str::limit(strip_tags(md_to_html($this->body())), $limit);
    // }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the tags that are attached to this model.
     */
    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function url()
    {
        return route('posts.show', $this->slug);
    }

    public function excerpt(int $limit = 100): string
    {
        return Str::limit(strip_tags($this->content), $limit);
    }
}
