<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';
    
    protected $fillable = [
        'brand_history', 'vision', 'mission', 'founder_story', 'founder_photo',
    ];

    public static function getInfo()
    {
        return self::first() ?? new self();
    }
}