<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'author',
        'status',
        'isImage',
        'image',
        'description',
        'source_id',
        'link',
        'guid',
        'created_at',
    ];

    public function getTitleAttribute($value)
    {
        return mb_strtoupper($value);
    }

    protected $casts = [
        'isImage' => 'boolean'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_has_news', 'news_id', 'category_id');
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
