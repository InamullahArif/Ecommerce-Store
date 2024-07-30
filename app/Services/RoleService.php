<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class RoleService
{
    public function getAllRoles($request, $perPage = 10)
    {
        // return Role::paginate($perPage);
        // return Role::where('name', '!=', 'super admin')->paginate($perPage);
        $query = Role::ApplyFilter($request->only(['search_by_name']))
            ->where('id', '!=', 1)->orderBy('created_at', 'desc');
        //  dd($query->get());
        return $query->paginate($perPage)->withQueryString();
    }


    public function addRole($request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        return $role;
    }
    public function getSingleRole($id)
    {
        $role = Role::find($id);
        return $role;
    }
    public function update($request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        return $role;
        // return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function deleteRole($id)
    {

        $role = Role::find($id);
        $role->delete();
        return $role;
    }

    public function showPermission()
    {
        // $permissions = Permission::all();
        $permissions = Permission::all()->groupBy('category');
        // dd($permissions);
        // $roles = Role::all();
        // $roles = Role::where('name', '!=', 'super admin')->get();
        $roles = Role::where('id', '!=', 1)->get();
        // dd($roles);
        $data['roles'] = $roles;
        $data['permissions'] = $permissions;
        return $data;
    }
    public function showUsersPermissions()
    {
        // $permissions = Permission::all();
        $permissions = Permission::all()->groupBy('category');
        // dd($permissions);
        // $users = User::where('name','!=','Super Admin')->get();
        $users = User::where('id', '!=', 1)->get();
        $data['users'] = $users;
        $data['permissions'] = $permissions;
        return $data;
    }
}
