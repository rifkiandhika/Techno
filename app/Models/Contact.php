<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    
    protected $fillable = [
        'whatsapp', 'email', 'instagram', 'tiktok', 'facebook', 'address',
    ];

    public static function getInfo()
    {
        return self::first() ?? new self();
    }
}