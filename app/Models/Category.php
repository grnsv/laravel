<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'categories';

    public static $availableFields = [
        'id',
        'title',
        'slug',
        'description',
        'created_at'
    ];

    protected $fillable = [
        'title',
        'slug',
        'description'
    ];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'categories_has_news', 'category_id', 'news_id');
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
