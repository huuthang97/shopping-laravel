<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index()  {
        $menus = $this->menu->latest()->paginate(5);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()  {
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $option = $recusive->menuRecusiveAdd(0,'');
        return view('admin.menus.add', compact('option'));
    }

    public function store(Request $request)  {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('menus.index');
    }

    public function edit($id)  {
        $menu = $this->menu->find($id);
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $option = $recusive->menuRecusiveAdd(0, $menu['parent_id']);
        return view('admin.menus.edit', compact('menu', 'option'));
    }

    public function update($id, Request $request) {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id) {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
