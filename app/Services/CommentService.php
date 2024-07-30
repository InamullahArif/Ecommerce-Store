<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class CommentService
{
    public function addComment($request)
    {
        // dd($request->all());
        if($request->parent_id)
        {
            $comment = Comment::create([
                'username' => $request->name,
                'email' => $request->email,
                'content' => $request->comment,
                'blog_id'=>$request->blog_id,
                'parent_id'=> $request->parent_id,
                'status'=>1,
            ]);
            return $comment;
        }
        $comment = Comment::create([
            'username' => $request->name,
            'email' => $request->email,
            'content' => $request->comment,
            'blog_id'=>$request->blog_id,
            'parent_id'=> null,
            'status'=>1,
        ]);
        return $comment;
    }
    public function getAllComments($request,$perPage=10)
    {
        $query = Comment::where('parent_id',null)->ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
        return $query->paginate($perPage)->withQueryString();
    }
    public function showComment($slug)
    {
        $comment = Comment::where('slug', $slug)->firstOrFail();
        return $comment;
    }
    public function changeStatus($request)
    {
        $comment = Comment::where('slug', $request->comment_id)->firstOrFail();
        if($request->status == 'active')
        {
        $comment->status = 1;
        }else
        {
        $comment->status = 0;
        }
        $comment->save();
        return $comment;
    }
}
