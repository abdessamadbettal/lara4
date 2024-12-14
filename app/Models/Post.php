<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Tags\HasTags;
use Spatie\Sitemap\Tags\Url;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model implements HasMedia , Sitemapable
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SoftDeletes, InteractsWithMedia, HasTags;

    protected $fillable = ['name', 'slug', 'content', 'author_id', 'category_id', 'is_published', 'time_to_read'];

    public $translatable = ['name', 'slug', 'content'];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
        'content' => 'array',
        'is_published' => 'boolean',
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

    public function toSitemapTag(): Url | string | array
    {
        return Url::create(route('blog.post.show', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
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

}
