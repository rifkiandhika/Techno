<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    
    protected $fillable = [
        'title', 'slug', 'category', 'content', 'featured_image', 
        'views', 'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now());
    }

    public function getExcerptAttribute()
    {
        return strlen(strip_tags($this->content)) > 150 
            ? substr(strip_tags($this->content), 0, 150) . '...' 
            : strip_tags($this->content);
    }
}