<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGallery extends Model
{
    protected $table = 'product_galleries';
    
    protected $fillable = [
        'product_id', 'image', 'type', 'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}