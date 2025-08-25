<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'slug', 'summary', 'body', 'read_duration', 'view_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(BlogImage::class)->where('is_primary', true);
    }

    public function categories()
    {
        return $this->hasMany(BlogCategory::class);
    }
}
