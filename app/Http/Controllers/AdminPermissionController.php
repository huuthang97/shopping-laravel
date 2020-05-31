<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class AdminPermissionController extends Controller
{

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index() {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.permission.index', compact('permissions'));
    }

    public function create() {
        return view('admin.permission.add');
    }

    public function store(Request $request) {
            $permission = $this->permission->create([
                'name' => $request->module,
                'display_name' => $request->module,
                'parent_id' => 0,
                'key_code' => trim($request->module),
            ]);

            foreach ( $request->module_childrent as $item ) {
                $this->permission->create([
                    'name' => $item . ' ' .$request->module,
                    'display_name' => $item . ' ' . $request->module,
                    'parent_id' => $permission->id,
                    'key_code' => trim($request->module . '_' . $item),
                ]);
            }
        
        
    }

    public function edit($id) {
        return view('admin.permission.edit');
    }

    public function update() {

    }

    public function delete() {

    }
}
