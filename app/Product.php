<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function productImages()
    {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Tag', 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
}
