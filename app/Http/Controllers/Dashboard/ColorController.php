<?php
namespace App\Http\Controllers\Dashboard;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ColorService;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class ColorController extends Controller
{
    private $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }
    public function index(Request $request)
    {
        // dd($request->all());
        try {
            $colors = $this->colorService->getAllColors($request);
            if ($request->ajax()) {
                $total_color_view  = '';
                if ($colors->count() > 0) {
                    foreach ($colors as $color) {
                        $color_view = (string)view('dashboard.WebsiteManagement.Colors.single-color-row', compact('color'));
                        $total_color_view = $total_color_view . $color_view;
                    }
                } else {
                    $color_view = (string)view('dashboard.WebsiteManagement.Colors.single-color-row');
                    $total_color_view = $total_color_view . $color_view;
                }
                return response()->json([
                    'data' => $total_color_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Colors.all-colors', compact('colors'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     try {
    //         // $roles = $this->roleService->getSingleRole($id);
    //         return view('dashboard.WebsiteManagement.colors.create-color');
    //     } catch (\Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:Colors,name',
        ]);
        try {
            $colors =  $this->colorService->addColor($request);
            // return redirect('/all-user')->with('success', 'User added successfully!');
            return response()->json([
                'success'=>true,
                'message'=>'Color added successfully',
                'color'=>$colors,
            ]);
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
    public function edit($slug)
    {
        // dd($slug);
        try {
            $colors = $this->colorService->getSingleColor($slug);
            return response()->json([
                'success'=>true,
                'color'=>$colors,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug)
    {
        // dd($request->all(),$slug);
        $request->validate([
            'name' => 'required|unique:colors,name',
        ]);
        try {
            $colors = $this->colorService->update($request,$slug);
            return response()->json([
                'success'=>true,
                'message'=>'Color updated successfully',
                'color'=>$colors,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $colors = $this->colorService->deleteColor($slug);
            return response()->json([
                'success'=>true,
                'message'=>'Color deleted successfully',
                'color'=>$colors,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
