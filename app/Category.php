<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    private $result = [];
    protected $fillable = ['name', 'parent_id', 'slug'];

    public function products() {
        return $this->hasMany('App\Product', 'category_id');
    }
    public function productRecursive($id) {
        // $result = [];
        $products = Product::where('category_id', $id)->get();

        foreach ($products as $product) {
            array_push($this->result, $product);
        }
        
        $categories_child = Category::where('parent_id', $id)->get();
        foreach ($categories_child as $category) {
            $this->productRecursive($category->id);
        }
        
        return $this->result;
    }
    
}

