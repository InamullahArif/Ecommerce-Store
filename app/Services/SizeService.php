<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Size;
use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class SizeService
{
    public function getAllSizes($request, $perPage = 10)
    {
        $query = Size::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
        return $query->paginate($perPage)->withQueryString();
    }
    public function addSize($request)
    {
        $size = Size::create([
            'name' => $request->name,
        ]);
        return $size;
    }
    public function getSingleSize($slug)
    {
      $size = Size::where('slug', $slug)->firstOrFail();
        return $size;
    }
    public function update($request, $slug)
    {
      $size = Size::where('slug', $slug)->firstOrFail();
        $size->name = $request->input('name');
        $size->save();
        return $size;
    }

    public function deleteSize($slug)
    {
      $size = Size::where('slug', $slug)->firstOrFail();
        $size->delete();
        return $size;
    }
}
