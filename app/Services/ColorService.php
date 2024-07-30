<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Color;
use App\Models\Image;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;


class ColorService
{
    public function getAllColors($request, $perPage = 10)
    {
        $query = Color::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
        return $query->paginate($perPage)->withQueryString();
    }
    public function addColor($request)
    {
        $color = Color::create([
            'name' => $request->name,
        ]);
        return $color;
    }
    public function getSingleColor($slug)
    {
      $color = Color::where('slug', $slug)->firstOrFail();
        return $color;
    }
    public function update($request, $slug)
    {
      $color = Color::where('slug', $slug)->firstOrFail();
        $color->name = $request->input('name');
        $color->save();
        return $color;
    }

    public function deleteColor($slug)
    {
      $color = Color::where('slug', $slug)->firstOrFail();
        $color->delete();
        return $color;
    }
}
