<?php

// namespace App\Http\Controllers\Dashboard;
namespace App\Http\Controllers\Dashboard;
use App\Models\Role;

use App\Models\User;

use Illuminate\Http\Request;
// use App\Services\RoleService;
use App\Services\PermissionService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class PermissionController extends Controller
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    // public function index(Request $request)
    // {
    //     try {
    //         $roles = $this->roleService->getAllRoles($request,10);
    //         // dd($roles->count());
    //         if ($request->ajax()) {
    //             $total_role_view  = '';
    //             if ($roles->count() > 0) {
    //                 foreach ($roles as $role) {
    //                     $role_view = (string)view('dashboard.single-role-row', compact('role'));
    //                     $total_role_view = $total_role_view . $role_view;
    //                 }
    //             } else {
    //                 $role_view = (string)view('dashboard.single-role-row');
    //                 $total_role_view = $total_role_view . $role_view;
    //             }
    //             // $paginationHtml = $users->paginate($perPage=10);
    //             return response()->json([
    //                 'data' => $total_role_view,
    //                 'success' => true,
    //                 // 'pagination' => $paginationHtml
    //             ]);
    //         }
    //         return view('dashboard.all-roles', compact('roles'));
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => 'required|unique:roles,name',
    //     ]);
    //     try {
    //         $role =  $this->roleService->addRole($request);
    //         // return redirect('/all-user')->with('success', 'User added successfully!');
    //         $notification = array(
    //             'message' => 'Role added successfully',
    //             'alert-type' => 'success'
    //         );
    
    //         return redirect()->route('all-roles')->with($notification);
    //         // return back()->with('success','User created successfully!');
    //     }catch (ValidationException $e) {
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (Exception $exception) {
    //         return $exception->getMessage();

    //     }
    // }
    // public function getRole($id)
    // {   
    //     // dd('here');
    //     try {
    //         $roles = $this->roleService->getSingleRole($id);
    //         return view('dashboard.create-role',compact('roles'));
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function updateRole(Request $request,$id)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:roles,name',
    //     ]);
    //     try {
    //         $users = $this->roleService->update($request,$id);
    //         // return redirect('/all-user');
    //         $notification = array(
    //             'message' => 'Role updated successfully',
    //             'alert-type' => 'success'
    //         );
    
    //         return redirect()->route('all-roles')->with($notification);
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function delete(Request $request,$id)
    // {
    //     // dd($id);
    //     try {
    //         $roles = $this->roleService->deleteRole($id);
    //         return response()->json([
    //             'success'=>true,
    //             'message'=>'Role deleted successfully',
    //             'role'=>$roles,
    //         ]);
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    public function showPermissions()
    {
        try {
            $rolesAndPermissions = $this->permissionService->showPermission();
            // dd($rolesAndPermissions);
            return view('dashboard.assign-permissions', compact('rolesAndPermissions'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function assignPermission(Request $request)
    {
        // dd($request->all());
        $role = Role::find($request['role_id']);
        if ($role) {
        $permissionsCollection = collect($request['permissions']);
        $permissionsToSync = $permissionsCollection->reject(function ($permission) {
            return strpos($permission, 'on') !== false;
        });
        // dd($permissionsToSync);
        $role->syncPermissions($permissionsToSync);
        return redirect()->back();
    }
    }
    public function getPermissions($id)
    {
        $role = Role::find($id);
        if ($role) {
          $permissions =  $role->permissions;
        //   dd($permissions);
        
        $permissions = $permissions->groupBy('module_id');
        return response()->json([
            'success'=>true,
            'data'=> $permissions,
        ]);
    }
    }
    public function getPermissionsUser($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);
        if ($user) {
          $permissions =  $user->permissions;

        //   dd($permissions);
        $permissions = $permissions->groupBy('module_id');
        return response()->json([
            'success'=>true,
            'data'=> $permissions,
        ]);
    }
    }

    public function assignPermissionToUser()
    {
        try {
            $rolesAndPermissions = $this->permissionService->showUsersPermissions();
            return view('dashboard.assign-user-permissions', compact('rolesAndPermissions'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function assignUserPermission(Request $request)
    {
        // dd($request->all());
        $user = User::find($request['user_id']);
        if ($user) {
        $permissionsCollection = collect($request['permissions']);
        $permissionsToSync = $permissionsCollection->reject(function ($permission) {
            return strpos($permission, 'on') !== false;
        });
        // dd($permissionsToSync);
        $user->syncPermissions($permissionsToSync);
        return redirect()->back();
    }
    }
    
    
}
