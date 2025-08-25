<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryMaster extends Model
{
    protected $table = 'blog_categories_master';

    protected $fillable = [
        'name'
    ];

    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'blog_category_master_id');
    }
}
