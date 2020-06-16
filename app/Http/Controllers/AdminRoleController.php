<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\Permission;


class AdminRoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(Request $request) {
        $roles = $this->role->all();
        return view('admin.role.index', compact('roles'));
    }

    public function create() {
        $permissions = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request) {
        try{
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $role = $this->role->create($dataInsert);
            $role->permissions()->attach($request->permission_id);
            DB::commit();

            return redirect()->route('roles.index');
        }
        catch(\Exception $e) {
            DB::rollBack();
            dd('Message: ' . $e->getMessage() . '  --File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
        
    }

    public function edit($id) {
        $role = $this->role->find($id);
        $permissions = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $role->permissions;
        return view('admin.role.edit', compact('permissions', 'role', 'permissionChecked'));
    }

    public function update(Request $request, $id) {
        try{
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $role = $this->role->find($id);
            $role->update($dataUpdate);
            $role->permissions()->sync($request->permission_id);
            DB::commit();

            return redirect()->route('roles.index');
        }
        catch(\Exception $e) {
            DB::rollBack();
            dd('Message: ' . $e->getMessage() . '  --File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
        
    }

    public function delete($id) {
        
        try {
            if ($this->role->find($id)->delete()) {
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            }
        }
        catch (\Exception $e) {
            dd($e->getMessage().'  -- File: '. $e->getFile().' ---Line: '. $e->getFile());
        }
    }

}
