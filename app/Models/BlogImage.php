<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_id', 'is_primary', 'image'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
