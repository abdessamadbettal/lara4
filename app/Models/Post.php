<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SoftDeletes, InteractsWithMedia, HasTags;

    protected $fillable = ['title', 'slug', 'content', 'author_id', 'category_id', 'is_published', 'time_to_read'];

    public $translatable = ['title', 'slug', 'content'];

    protected $casts = [
        'title' => 'array',
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
