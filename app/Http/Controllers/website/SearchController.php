<?php

namespace App\Http\Controllers\website;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = $request->input('query');
    //         $results = $this->searchAcrossModels($query,$request);

    //         return response()->json($results);
    //     }

    // }
    // public function goToSearch(Request $request)
    // {
    //     $model = $request['model'];
    //     $modelClass = 'App\\Models\\' . ucfirst($model);
    //     if($modelClass)
    //     {
    //        $data = $modelClass::find($request['id']);
    //        return response()->json(['data'=>$data]);
    //     }
    //        return response()->json(['data'=>[]]);
    // }
    // private function globalSearch($query)
    // {
    //     $results = collect();

    //     $models = [
    //         Product::class,
    //         Blog::class,
    //     ];
        
    //     foreach ($models as $model) {
    //         $modelName = class_basename($model); 
            
    //         $modelResults = $model::search($query)->get()->map(function ($item) use ($modelName) {
    //             $item->model = $modelName;
    //             return $item;
    //         });
    //         $results = $results->merge($modelResults);
    //     }
      
        
    //     return $results;
    // }
    // function searchAcrossModels($query,Request $request)
    // {
    //     $url = $request->url();
    //     $url = parse_url($url);
    //     if($url['path'] == '/searchDashboard')
    //     {
    //         $models = [
    //             Product::class,
    //             Blog::class,
    //             User::class,
    //         ];
    //     }else
    //     {
    //         $models = [
    //             Product::class,
    //             Blog::class,
    //         ];
    //     }
        
    //     $searchResults = [];
    //     foreach ($models as $modelClass) {
    //         $modelName = class_basename($modelClass); 
    //         $searchableFields = $modelClass::searchableFields();
        
    //         foreach ($searchableFields as $field) {
    //             $results = $modelClass::where($field, 'like', '%' . $query . '%')->get();
        
    //             if ($results->isNotEmpty()) {
    //                 foreach ($results as $result) {
    //                     $exists = false;
        
    //                     if (isset($searchResults[$modelName])) {
    //                         foreach ($searchResults[$modelName] as $existingResult) {
    //                             if ($existingResult['result']->id == $result->id) {
    //                                 $exists = true;
    //                                 break;
    //                             }
    //                         }
    //                     }
    //                     if (!$exists) {
    //                         $searchResults[$modelName][] = [
    //                             'result' => $result,
    //                         ];
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $searchResults;
    // }
}
