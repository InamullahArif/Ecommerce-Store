<?php

namespace App\Http\Controllers\Dashboard;
// namespace App\Http\dashboard\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        // dd($request->all());
        try {
            $categories = $this->categoryService->getAllCategories($request,10);
            if ($request->ajax()) {
                $total_category_view  = '';
                if ($categories->count() > 0) {
                    foreach ($categories as $category) {
                        $category_view = (string)view('dashboard.WebsiteManagement.Categories.single-category-row', compact('category'));
                        $total_category_view = $total_category_view . $category_view;
                    }
                } else {
                    $category_view = (string)view('dashboard.WebsiteManagement.Categories.single-category-row');
                    $total_category_view = $total_category_view . $category_view;
                }
                return response()->json([
                    'data' => $total_category_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Categories.all-categories', compact('categories'));
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
    //         return view('dashboard.WebsiteManagement.Categories.create-category');
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
            'name' => 'required|unique:categories,name',
            'description' => 'required',
        ]);
        $count = Category::all()->count();
        try {
            $categories =  $this->categoryService->addCategory($request);
            // return redirect('/all-user')->with('success', 'User added successfully!');
            return response()->json([
                'success'=>true,
                'message'=>'Category added successfully',
                'category'=>$categories,
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
    public function edit($id)
    {
        // dd($id);
        try {
            $categories = $this->categoryService->getSingleCategory($id);
            return response()->json([
                'success'=>true,
                'category'=>$categories,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        // dd($request->all(),$id);
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        try {
            $categories = $this->categoryService->update($request,$id);
            return response()->json([
                'success'=>true,
                'message'=>'Category updated successfully',
                'category'=>$categories,
            ]);
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
            $categories = $this->categoryService->deleteCategory($id);
            return response()->json([
                'success'=>true,
                'message'=>'Category deleted successfully',
                'category'=>$categories,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
