<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserAddRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;


class AdminUserController extends Controller
{
    private $role;
    private $user;

    public function __construct(Role $role, User $user)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function index() {
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create() {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request) {
        try {
            DB::beginTransaction();
            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
            ];
            $user = $this->user->create($dataInsert);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            dd('Message: ' . $e->getMessage() . '  -- File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
        
    }

    public function edit($id) {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
            ];
            $user = $this->user->find($id)->update($dataUpdate);
            $this->user->find($id)->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            dd('Message: ' . $e->getMessage() . '  -- File: ' . $e->getFile() . '  --Line: ' . $e->getLine());
        }
    }

    public function delete($id) {
        try {
            if ( $this->user->find($id)->delete() ) {
                return response()->json([
                    'code' => 200,
                    'mesage' => 'success'
                ], 200);
            }
        }
        catch (\Exception $e) {
            dd('Mesage: '. $e->getMessage().' --File:  '.$e->getFile().'  --Line:   '. $e->getLine() );
        }
    }
}
