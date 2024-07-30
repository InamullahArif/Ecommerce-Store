<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Image;
use App\Models\Navbar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class BlogService
{
   public function getBlogs($request,$perPage=10)
   {
    $query = Blog::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
    return $query->paginate($perPage)->withQueryString();
   }
   public function getCateogries()
   {
    $categories = Category::all();
    return $categories;
   }
   public function createBlog()
   {
      
    
   }
   public function storeBlog($request)
   {
      // dd($request->category_id);
      $createdBy = Auth()->user();
      // dd($createdBy->name);
      $blog = Blog::create([
         'title' => $request->title,
         'author_name'=>$request->author_name,
         'description' => $request->description,
         'qoute'=>$request->qoute,
         'qoute_author_name'=>$request->qoute_author_name,
         'created_by' => $createdBy->name,
         'category_id' => $request->category_id,
     ]);
     if ($request->hasFile('image')) {
      $imageName = time().'.'.$request->image->extension(); 
      $request->image->move(public_path('blog_images'), $imageName);
      $imageUrl = 'blog_images/' . $imageName;
      $image = new Image(['name' => $imageUrl]);
      $blog->image()->save($image);
  }else
  {
      // $image = Image::findOrFail(1);
      // $image = 'user_images/user.jpg';
      $imageUrl = 'blog_images/blog.jpg';
      $image = new Image(['name' => $imageUrl]);
      $blog->image()->save($image);
  }
     return $blog;
   }
   public function editBlog($slug)
   {
      $blog = Blog::with('image')->where('slug', $slug)->firstOrFail();
      return $blog;
   }
   public function updateBlog($request,$slug)
   {
      // dd($request->all(),$slug);
      $createdBy = Auth()->user();
      $blog = Blog::where('slug', $slug)->firstOrFail();
            $blog->title = $request->input('title');
            $blog->description = $request->input('description');
            $blog->author_name = $request->input('author_name');
            $blog->category_id = $request->input('category_id');
            $blog->qoute = $request->input('qoute');
            $blog->qoute_author_name = $request->input('qoute_author_name');
            $blog->created_by = $createdBy->name;
            if ($request->hasFile('image')) {
                if(($blog->image) == null)
                {
                    $imageName = time().'.'.$request->image->extension(); 
                    $request->image->move(public_path('blog_images'), $imageName);
                    $imageUrl ='blog_images/' . $imageName;
                    $image = new Image(['name' => $imageUrl]);
                    $blog->image()->save($image);
                }else
                {
                    if(!$blog->image->name == 'blog_images/blog.jpg')
                    {
                        if(File::exists(public_path($blog->image->name))){
                            File::delete(public_path($blog->image->name));
                        }
                    }
                    $imageName = time() . '.' . $request->image->extension(); 
                    $request->image->move(public_path('blog_images'), $imageName);
                    $existingImage = $blog->image;
                    $existingImage->name = 'blog_images/' . $imageName;
                    $existingImage->save();
                }
                
            }
                $blog->save();
                return $blog;
      
   }
   public function deleteBlog($slug)
   {
    $blog = Blog::where('slug', $slug)->firstOrFail();
    if($blog)
    {
        $blog->delete();
        return $blog;
    }
   }
   public function getBlog($slug)
{
      $blog = Blog::where('slug', $slug)->firstOrFail();
      $category = Category::find($blog->category_id);
    if($category)
      {
         $blog['category'] = $category;
      }
      return $blog;
   }
   public function getAllBlogs($perPage=10)
   {
    // $blogs = Blog::with('image')->get();
    $query = Blog::orderBy('created_at', 'desc');
    return $query->paginate($perPage)->withQueryString();
   }
   public function showBlogg($slug)
   {
    $blog = Blog::with(['image', 'comments' => function ($query) {
        $query->where('status',true);
    }])->where('slug', $slug)->first();
    if($blog)
    {
    return $blog;
    }
    // return null;
   }
}
