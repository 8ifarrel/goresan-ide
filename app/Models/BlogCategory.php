<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = [
        'blog_id', 'blog_category_master_id'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function master()
    {
        return $this->belongsTo(BlogCategoryMaster::class, 'blog_category_master_id');
    }
}
