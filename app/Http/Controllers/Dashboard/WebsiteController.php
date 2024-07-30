<?php

namespace App\Http\Controllers\Dashboard;
// namespace App\Http\dashboard\Controllers;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;

use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;
use App\Services\WebsiteService;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    private $wesbsiteService;
    public function __construct(WebsiteService $wesbsiteService)
    {
        $this->wesbsiteService = $wesbsiteService;
    }
    public function navbar(Request $request)
    {
        try {
            $navs = $this->wesbsiteService->nav();
            // dd($users);
            return view('dashboard.WebsiteManagement.manage-navbar', compact('navs'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    // public function navbarStore(Request $request)
    // {
    //     // dd($request->all());
    //     // $request->validate([
    //     //     'name' => 'required|array',
    //     //     'name.*' => 'required|string',
    //     //     'link' => 'required|array',
    //     //     'link.*' => 'required|string',
    //     // ]);
    //     // dd('here');
    //     try {
    //         $navs = $this->wesbsiteService->navStore($request);
    //         $notification = array(
    //             'message' => 'Navbar settings updated successfully',
    //             'alert-type' => 'success'
    //         );
    //         return redirect()->route('navbar.index')->with($notification);
    //         // return back();
    //     }catch (ValidationException $e) {
    //         // dd($e->errors());
    //         return redirect()->back()->withErrors($e->errors())->withInput();
    //     } catch (Exception $exception) {
    //         return $exception->getMessage();

    //     }
    // }
    public function navbarStore(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|array',
        //     'name.*' => 'required|string',
        //     'link' => 'required|array',
        //     'link.*' => 'required|string',
        // ]);
        // dd('here');
        
    // dd($navbars);
        try {
            $navs = $this->wesbsiteService->navStore($request);
            $notification = array(
                'message' => 'Navbar settings updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('navbar.index')->with($notification);
            // return back();
        }catch (ValidationException $e) {
            // dd($e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }
  
}
