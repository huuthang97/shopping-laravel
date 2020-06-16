<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use category as GlobalCategory;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    public function index() {
        $categories = $this->category->latest()->paginate(5);
        return view('category.index', compact('categories'));
    }

    public function create() {
        $data = $this->category->all(); ;
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive('');
        return view('category.add', compact('htmlOption'));
    }

    public function store(Request $request) { 
        $this->category->create([
            'name' => $request->name,
            'parent_id' => +$request->parent_id,
            'slug' => Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id) {
        $category = $this->category->find($id);
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($category['parent_id']);
        return view('category.edit', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request) {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => +$request->parent_id,
            'slug' => Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id) {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }
}

