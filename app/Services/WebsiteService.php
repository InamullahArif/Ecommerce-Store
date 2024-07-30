<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Navbar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class WebsiteService
{
    public function nav()
    {
        $nav = Navbar::with('image')->first();
        return $nav;
    }
    // public function navStore($request)
    // {
    //     // dd($request->has('name'));
    //     if($request->has('name') && $request->has('link')){
    //         // dd('here');
    //     $data = $request->only(['name', 'link']);
    //     $navbarItems = [];
    //     foreach ($data['name'] as $index => $name) {
    //         $navbarItems[] = [
    //             'name' => $name,
    //             'link' => $data['link'][$index],
    //         ];
    //     }
    //     $navbarJson = json_encode($navbarItems);
    //     // dd($navbarJson);
    //     Log::info('Navbar JSON:', ['data' => $navbarJson]);
    // }else
    // {
    //     $navbarJson = null;
    // }
    //     $navbar = Navbar::find(1);
    //     if ($navbar) {
    //         $navbar->update([
    //             'data' => $navbarJson,
    //     ]);
    //     } else {
    //         $navbar = Navbar::create([
    //             'data' => $navbarJson,
    //         ]);
    //     }
    //     if ($request->hasFile('image')) {
    //         if(($navbar->image) == null)
    //                 {
    //                     $imageName = time().'.'.$request->image->extension(); 
    //                     $request->image->move(public_path('nav_images'), $imageName);
    //                     $imageUrl ='nav_images/' . $imageName;
    //                     $image = new Image(['name' => $imageUrl]);
    //                     $navbar->image()->save($image);
    //                 }else
    //                 {
    //                     // dd($navbar->image->name);
    //                     // dd(File::exists(public_path($navbar->image->name)));
    //                     if($navbar->image->name != 'website/img/logo.png')
    //                     {
    //                         // dd(File::exists(public_path($navbar->image->name)));
    //                         if(File::exists(public_path($navbar->image->name))){
    //                             // dd('1');
    //                             File::delete(public_path($navbar->image->name));
    //                         }
    //                     }
    //                     $imageName = time() . '.' . $request->image->extension(); 
    //                     $request->image->move(public_path('nav_images'), $imageName);
    //                     $existingImage = $navbar->image;
    //                     $existingImage->name = 'nav_images/' . $imageName;
    //                     $existingImage->save();
    //                 }
    //     }

    //     if ($navbar) {
    //         Log::info('Navbar stored successfully:', ['id' => $navbar->id]);
    //     } else {
    //         Log::error('Failed to store Navbar data');
    //     }
    //     return $navbarJson;
    // }
    public function navStore($request)
    {
        // dd($request->has('name'));
        $navbars = [];
    
        foreach ($request->name as $index => $name) {
            $navbar = [
                'name' => $name,
                'link' => $request->link[$index],
                'subfields' => []
            ];
    
            if (isset($request->sub_name[$index])) {
                foreach ($request->sub_name[$index] as $subIndex => $subName) {
                    $navbar['subfields'][] = [
                        'sub_name' => $subName,
                        'sub_link' => $request->sub_link[$index][$subIndex] ?? null,
                    ];
                }
            }
    
            $navbars[] = $navbar;
        }
        // dd($navbars);
        $navbarJson = json_encode($navbars);
        $navbar = Navbar::find(1);
        if ($navbar) {
            $navbar->update([
                'data' => $navbarJson,
        ]);
        } else {
            $navbar = Navbar::create([
                'data' => $navbarJson,
            ]);
        }
        if ($request->hasFile('image')) {
            if(($navbar->image) == null)
                    {
                        $imageName = time().'.'.$request->image->extension(); 
                        $request->image->move(public_path('nav_images'), $imageName);
                        $imageUrl ='nav_images/' . $imageName;
                        $image = new Image(['name' => $imageUrl]);
                        $navbar->image()->save($image);
                    }else
                    {
                        // dd($navbar->image->name);
                        // dd(File::exists(public_path($navbar->image->name)));
                        if($navbar->image->name != 'website/img/logo.png')
                        {
                            // dd(File::exists(public_path($navbar->image->name)));
                            if(File::exists(public_path($navbar->image->name))){
                                // dd('1');
                                File::delete(public_path($navbar->image->name));
                            }
                        }
                        $imageName = time() . '.' . $request->image->extension(); 
                        $request->image->move(public_path('nav_images'), $imageName);
                        $existingImage = $navbar->image;
                        $existingImage->name = 'nav_images/' . $imageName;
                        $existingImage->save();
                    }
        }

        if ($navbar) {
            Log::info('Navbar stored successfully:', ['id' => $navbar->id]);
        } else {
            Log::error('Failed to store Navbar data');
        }
        return $navbarJson;
    }

}
