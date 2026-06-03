<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'code', 'name', 'slug', 'category_id', 'description', 'gender',
        'status', 'thumbnail', 'views', 'top_notes', 'middle_notes',
        'base_notes', 'longevity', 'sillage', 'projection', 
        'is_featured', 'is_best_seller'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean',
        'views' => 'integer',
        'longevity' => 'integer',
        'sillage' => 'integer',
        'projection' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function getLowestPriceAttribute()
    {
        return $this->variants->min('price') ?? 0;
    }

    public function getHighestPriceAttribute()
    {
        return $this->variants->max('price') ?? 0;
    }

    public function getTotalStockAttribute()
    {
        return $this->variants->sum('stock');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('is_best_seller', true);
    }
}