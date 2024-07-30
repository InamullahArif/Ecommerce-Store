<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class CategoryService
{
    public function getAllCategories($request, $perPage = 10)
    {
        $query = Category::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
        return $query->paginate($perPage)->withQueryString();
    }
    public function addCategory($request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return $category;
    }
    public function getSingleCategory($id)
    {
        $category = Category::find($id);
        
        return $category;
    }
    public function update($request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }
}
