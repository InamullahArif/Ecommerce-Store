<?php

namespace App\Http\Controllers\Dashboard;
// namespace App\Http\dashboard\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Services\UserService;
use App\Services\WebsiteService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class BlogController extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index(Request $request)
    {
        try {
            $blogs = $this->blogService->getBlogs($request,10);
            // dd($blogs->count());
            if ($request->ajax()) {
                $total_blog_view  = '';
                $i = 0;
                if ($blogs->count() > 0) {
                    foreach ($blogs as $blog) {
                        $blog_view = (string)view('dashboard.WebsiteManagement.Blogs.single-blog-row', compact('blog'));
                        $total_blog_view = $total_blog_view . $blog_view;
                    }
                } else {
                    $blog_view = (string)view('dashboard.WebsiteManagement.Blogs.single-blog-row');
                    $total_blog_view = $total_blog_view . $blog_view;
                }
                return response()->json([
                    'data' => $total_blog_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Blogs.all-blogs', compact('blogs'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function create()
    {
        try {
            $cat = $this->blogService->getCateogries();
            return view('dashboard.WebsiteManagement.Blogs.add-new-blog',compact('cat'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function show($slug)
    {
        try {
            $blogs = $this->blogService->getBlog($slug);
            return view('dashboard.WebsiteManagement.Blogs.view-blog',compact('blogs'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'qoute_author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'qoute' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);
        try {
            $blog =  $this->blogService->storeBlog($request);
            $notification = array(
                'message' => 'Blog added successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-blog')->with($notification);
            // return back()->with('success','User created successfully!');
        }catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $exception) {
            return $exception->getMessage();

        }
    }
    public function edit($slug)
    {
        try {
            $blogs = $this->blogService->editBlog($slug);
            $category = Category::where('id',$blogs->category_id)->first();
            $cat = Category::all();
            return view('dashboard.WebsiteManagement.Blogs.add-new-blog',compact('blogs','category','cat'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function update(Request $request,$slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);
        try {
            $users = $this->blogService->updateBlog($request,$slug);
            $notification = array(
                'message' => 'Blog updated successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->route('show-blog')->with($notification);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function destroy($slug)
    {
        // dd($slug);
        try {
            $blogs = $this->blogService->deleteBlog($slug);
            return response()->json([
                'success'=>true,
                'message'=>'Blog deleted successfully',
                'blog'=>$blogs,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    
}
