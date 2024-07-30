<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    public function index(Request $request)
    {
        try {
            $roles = $this->roleService->getAllRoles($request,10);
            // dd($roles->count());
            if ($request->ajax()) {
                $total_role_view  = '';
                $i = 0;
                if ($roles->count() > 0) {
                    foreach ($roles as $role) {
                        $i++;
                        $role['i'] = $i;
                        $role_view = (string)view('dashboard.single-role-row', compact('role'));
                        $total_role_view = $total_role_view . $role_view;
                    }
                } else {
                    $role_view = (string)view('dashboard.single-role-row');
                    $total_role_view = $total_role_view . $role_view;
                }
                // $paginationHtml = $users->paginate($perPage=10);
                return response()->json([
                    'data' => $total_role_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            }
            return view('dashboard.all-roles', compact('roles'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // $roles = $this->roleService->getSingleRole($id);
            return view('dashboard.create-role');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        try {
            $role =  $this->roleService->addRole($request);
            // return redirect('/all-user')->with('success', 'User added successfully!');
            $notification = array(
                'message' => 'Role added successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('roles.index')->with($notification);
            // return back()->with('success','User created successfully!');
        }catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $roles = $this->roleService->getSingleRole($id);
            return view('dashboard.create-role',compact('roles'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        try {
            $users = $this->roleService->update($request,$id);
            // return redirect('/all-user');
            $notification = array(
                'message' => 'Role updated successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('roles.index')->with($notification);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $roles = $this->roleService->deleteRole($id);
            return response()->json([
                'success'=>true,
                'message'=>'Role deleted successfully',
                'role'=>$roles,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
