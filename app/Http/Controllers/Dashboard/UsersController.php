<?php

// namespace App\Http\Controllers\dashboard;
namespace App\Http\Controllers\Dashboard;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class UsersController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
}
    // public function index(Request $request)
    // {
    //     // dd($request->all());
    // try {
    //         $users = $this->userService->getAllUsers($request,10);
    //         // dd($users);
    //         if ($request->ajax()) {
    //             $total_user_view  = '';
    //             if ($users->count() > 0) {
    //                 foreach ($users as $user) {
    //                     $user_view = (string)view('dashboard.single-user-row', compact('user'));
    //                     $total_user_view = $total_user_view . $user_view;
    //                 }
    //             } else {
    //                 $user_view = (string)view('dashboard.single-user-row');
    //                 $total_user_view = $total_user_view . $user_view;
    //             }
    //             // $paginationHtml = $users->paginate($perPage=10);
    //             return response()->json([
    //                 'data' => $total_user_view,
    //                 'success' => true,
    //                 // 'pagination' => $paginationHtml
    //             ]);
    //         }
    //         return view('dashboard.all-user', compact('users'));
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function showUser()
    // {
    //     try {
    //         $roles = $this->userService->getAllRoles();
    //         return view('dashboard.add-new-user', compact('roles'));
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'phoneNo' => 'required|numeric|digits:11',
    //         'password' => 'required|min:8',
    //         'image' => 'required|image',
    //     ]);
    //     try {
    //         $user =  $this->userService->addUser($request);
    //         // return redirect('/all-user')->with('success', 'User added successfully!');
    //         $notification = array(
    //             'message' => 'User added successfully',
    //             'alert-type' => 'success'
    //         );
    
    //         return redirect()->route('all-user')->with($notification);
    //         // session()->put('success', 'User created successfully.');
    //         // return back()->with('success','User created successfully!');
    //         return back();
    //     }catch (ValidationException $e) {
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (Exception $exception) {
    //         return $exception->getMessage();

    //     }
    // }
    // public function getUser($id)
    // {   
    //     // dd('here');
    //     try {
    //         $users = $this->userService->getSingleUser($id);
    //         // dd($users->roles);
    //         // dd(request()->route()->getName());
    //         $rol = $users->roles->first();
    //         // dd($rol);
    //         $roles = Role::all();
    //         if (request()->route()->getName() === 'editUser') {
    //             // If it is, load the 'add-new-user' view
    //             return view('dashboard.add-new-user', compact('users','rol','roles'));
    //         } else {
    //             // Otherwise, load the 'view-user' view
    //             return view('dashboard.view-user', compact('users'));
    //         }
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function updateUser(Request $request,$id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phoneNo' => 'required|numeric|digits:11',
    //     ]);
    //     try {
    //         $users = $this->userService->update($request,$id);
    //         // return redirect('/all-user');
    //         $notification = array(
    //             'message' => 'User updated successfully',
    //             'alert-type' => 'success'
    //         );
    
    //         return redirect()->route('all-user')->with($notification);
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    // public function delete(Request $request,$id)
    // {
    //     // dd($id);
    //     try {
    //         $users = $this->userService->deleteUser($id);
    //         return response()->json([
    //             'success'=>true,
    //             'message'=>'User deleted successfully',
    //             'user'=>$users,
    //         ]);
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
//     public function updateUserProfile(Request $request,$id)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|email|unique:users,email',
//             // 'phoneNo' => 'required|numeric|digits:11|regex:/^03[0-9]{9}$/',
//             'image' => 'required|image',
//         ]);
//         // dd($request->all(),$id);
//         $users = $this->userService->updateProfile($request,$id);
//         // $user->update($request->all());
//         $notification = array(
//             'message' => 'User profile updated successfully',
//             'alert-type' => 'success'
//         );

//         return redirect()->route('dashboard.index')->with($notification);
// }
//     public function showUserProfile($id)
//     {
//     // dd($id);
//         $user = $this->userService->showProfile($id);
//         return view('dashboard.user-profile',compact('user'));;
//     }
}
