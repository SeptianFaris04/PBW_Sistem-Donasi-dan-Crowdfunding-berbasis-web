<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index(){
        $users = User::with('roles', 'permissions')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('role-management.index', compact('users', 'roles', 'permissions'));
    }

    public function updateRole(Request $request, User $user){
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $role = Role::findOrFail($request->role_id);
        $user->syncRoles($role->name);

        return redirect()->back()->with('success', 'Role berhasil diubah');
    }

    public function addPermission(Request $request, $id){
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);
        $user = User::findOrFail($id);
        $permission = Permission::findOrFail($request->permission_id);
        $user->givePermissionTo($permission->name);

        return redirect()->back()->with('success', 'Permission berhasil ditambahkan');
    }

    public function removePermission(Request $request, User $user){
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);
        $user = User::findOrFail($user->id);
        $permission = Permission::findOrFail($request->permission_id);
        $user->revokePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission berhasil dihapus');
    }
}
