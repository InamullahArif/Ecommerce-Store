<?php

namespace App\Http\Controllers\website;
// namespace App\Http\dashboard\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Services\UserService;
use App\Services\WebsiteService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class BlogsController extends Controller
{
    private $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index(Request $request)
    {
        try {
            $blogs = $this->blogService->getAllBlogs(10);
            // dd($blogs);
            return view('website.blog', compact('blogs'));
            } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function Blogshow($slug)
    {
        try {
            // dd($slug);
            $blogs = $this->blogService->showBlogg($slug);
            // dd($blogs);
            return view('website.article',compact('blogs'));
            } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
  
    
    
}
