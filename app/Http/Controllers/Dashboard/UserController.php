<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Dashboard;


use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    // public static function middleware(): array
// {
    // return [
        // examples with aliases, pipe-separated names, guards, etc:
        // 'role_or_permission:manager|edit articles',
        // new Middleware('CheckPermissions', only: ['index']),
        // new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
        // new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view_users,web'), only:['index']),
    // ];
// }
    public function index(Request $request)
    {
        try {
            $users = $this->userService->getAllUsers($request,10);
            // dd($users);
            if ($request->ajax()) {
                $total_user_view  = '';
                if ($users->count() > 0) {
                    foreach ($users as $user) {
                        $user_view = (string)view('dashboard.single-user-row', compact('user'));
                        $total_user_view = $total_user_view . $user_view;
                    }
                } else {
                    $user_view = (string)view('dashboard.single-user-row');
                    $total_user_view = $total_user_view . $user_view;
                }
                // $paginationHtml = $users->paginate($perPage=10);
                return response()->json([
                    'data' => $total_user_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            }
            return view('dashboard.all-user', compact('users'));
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
            $roles = $this->userService->getAllRoles();
            return view('dashboard.add-new-user', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|digits:11|regex:/^03[0-9]{9}$/',
            'password' => 'required|min:8',
            // 'image' => 'required|image',
        ]);
        try {
            $user =  $this->userService->addUser($request);
            $this->sendEmail($user);
            $this->createNotifications($user);
            // return redirect('/all-user')->with('success', 'User added successfully!');
            $notification = array(
                'message' => 'User added successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('users.index')->with($notification);
            // session()->put('success', 'User created successfully.');
            // return back()->with('success','User created successfully!');
            return back();
        }catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }

    public function sendEmail($user)
    {
        try {
            $users = $this->userService->sendEmailToUser($user);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function createNotifications($name,$detail)
    {
        try {
            $users = $this->userService->createNotication($name,$detail);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $users = $this->userService->getSingleUser($id);
            // dd($users->roles);
            // dd(request()->route()->getName());
            $rol = $users->roles->first();
            // dd($rol);
            $roles = Role::all();
                return view('dashboard.view-user', compact('users'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $users = $this->userService->getSingleUser($id);
            $rol = $users->roles->first();
            $roles = Role::where('name' ,'!=','super admin')->get();
                return view('dashboard.add-new-user', compact('users','rol','roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|digits:11|regex:/^03[0-9]{9}$/',
        ]);
        try {
            $users = $this->userService->update($request,$id);
            // return redirect('/all-user');
            $notification = array(
                'message' => 'User updated successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('users.index')->with($notification);
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
            $users = $this->userService->deleteUser($id);
            return response()->json([
                'success'=>true,
                'message'=>'User deleted successfully',
                'user'=>$users,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function updateUserProfile(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'phoneNo' => 'required|numeric|digits:11|regex:/^03[0-9]{9}$/',
            // 'image' => 'required|image',
        ]);
        // dd($request->all(),$id);
        $users = $this->userService->updateProfile($request,$id);
        // $user->update($request->all());
        $notification = array(
            'message' => 'User profile updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard.index')->with($notification);
}
    public function showUserProfile($id)
    {
        $user = $this->userService->showProfile($id);
        return view('dashboard.user-profile',compact('user'));;
    }
}
