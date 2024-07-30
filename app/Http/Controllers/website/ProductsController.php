<?php

namespace App\Http\Controllers\website;

use App\Models\Color;
use App\Models\Category;
use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\NotificationController;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class ProductsController extends Controller
{
    private $productService;
    public function __construct(productService $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        try {
            $products = $this->productService->getProducts($request, 10);
            $categories = Category::all();
            if (isset($products['category_name'])) {
                $category_name = $products['category_name'];
                $products = $products['products'];
                return view('website.collection-left-sidebar', compact('products', 'categories', 'category_name'));
            } elseif (isset($products['stock'])) {
                $stock = $products['stock'];
                $products = $products['products'];
                return view('website.collection-left-sidebar', compact('products', 'categories', 'stock'));
            }
            return view('website.collection-left-sidebar', compact('products', 'categories'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function showProduct($slug)
    {
        try {
            $products = $this->productService->getProductWeb($slug);
            return view('website.product', compact('products'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function getQuantity(Request $request)
    {
        $quantities = Quantity::where('product_id', $request->product_id)
                              ->where('size_id', $request->size_id)
                              ->get();
        $colorIds = $quantities->pluck('color_id')->unique();
        $colors = Color::whereIn('id', $colorIds)->get();
        if ($colors) {
            return response()->json(['quantities'=>$quantities,'colors'=>$colors]);
        } else {
            return response()->json(['quantity' => 0], 404); 
        }
    }
    public function getQuantityColor(Request $request)
    {
        $quantities = Quantity::where('product_id', $request->product_id)
                              ->where('size_id', $request->size_id)
                              ->where('color_id', $request->color_id)
                              ->get();
        if ($quantities) {
            return response()->json(['quantities'=>$quantities]);
        } else {
            return response()->json(['quantity' => 0], 404); 
        }
    }
    public function Order(Request $request)
    {
        // dd($request->all());
        // dd($request->url()->previous());
        $currentUrl = url()->previous();
        $parsedUrl = parse_url($currentUrl, PHP_URL_PATH);
        $segments = explode('/', trim($parsedUrl, '/'));
        $lastSegment = end($segments);
        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'second_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_no' => 'required|string|max:20',
                'country' => 'required|string',
                'city' => 'required|string',
                'zip_code' => 'required|string|max:10',
                'shipping_address' => 'required|string|max:255',
                'billing_address' => 'required|string|max:255',
                'payment_method'=>'required',
            ]);
            // dd($request->all());
            $order = $this->productService->saveShippingDetails($request,$lastSegment);
            $userService = new UserService();
            $userController= new UserController($userService);

            $userController->createNotifications('Order placed successfully',$request->first_name . 'has placed an order');
            // return view('website.product', compact('products'));
            return response()->json(['success'=>true,'order'=>$order]);
        } catch (Exception $exception) {
            return response()->json(['success' => false, 'error' => $exception->getMessage()], 500);
        }
    }
}
