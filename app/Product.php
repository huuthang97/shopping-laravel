<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function productImages()
    {
        return $this->hasMany('App\ProductImage', 'product_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function comments(){ 
        return $this->hasMany('App\Comment', 'product_id', 'id');
    }
}
