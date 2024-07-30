<?php

// namespace App\Http\Controllers\Dashboard;
namespace App\Http\Controllers\Dashboard;

use App\Models\Size;

use App\Models\Color;
use App\Models\Category;
use App\Models\Quantity;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class ProductController extends Controller {
    private $productService;

    public function __construct( ProductService $productService ) {
        $this->productService = $productService;
    }

    public function index( Request $request ) {
        try {
            $products = $this->productService->getProducts( $request, 10 );
            $descriptions = $this->productService->getProductsDescriptions();
            // dd( $blogs->count() );
            if ( $request->ajax() ) {
                $total_product_view  = '';
                $i = 0;
                if ( $products->count() > 0 ) {
                    foreach ( $products as $product ) {
                        $product_view = ( string )view( 'dashboard.WebsiteManagement.Products.single-product-row', compact( 'product' ) );
                        $total_product_view = $total_product_view . $product_view;
                    }
                } else {
                    $product_view = ( string )view( 'dashboard.WebsiteManagement.Products.single-product-row' );
                    $total_product_view = $total_product_view . $product_view;
                }
                return response()->json( [
                    'data' => $total_product_view,
                    'success' => true,
                ] );
            }
            return view( 'dashboard.WebsiteManagement.Products.all-products', compact( 'products', 'descriptions' ) );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }

    public function create() {
        try {
            $cat = $this->productService->getCategories();
            $colors = $this->productService->getColors();
            $sizes = $this->productService->getSizes();
            return view( 'dashboard.WebsiteManagement.Products.add-new-product1', compact( 'cat', 'colors', 'sizes' ) );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }

    public function show( $slug ) {
        try {
            $products = $this->productService->getProduct( $slug );
            $quantities = $products->quantities;
            $data = [];
            foreach ( $quantities as $index => $quantity ) {
                $color = Color::where( 'id', $quantity[ 'color_id' ] )->first();
                $size = Size::where( 'id', $quantity[ 'size_id' ] )->first();
                $pair = [
                    'color' => $color,
                    'size' => $size
                ];
                $data[] = $pair;
            }
            return view( 'dashboard.WebsiteManagement.Products.view-product1', compact( 'products', 'data' ) );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }

    public function store( Request $request ) {
        // dd( 'here' );
        $messages = [
            'products.*.colors.size' => 'You can only select one color per record.',
            'products.*.sizes.size' => 'You can only select one size per record.',
        ];
        $request->validate( [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'shipping_returns' => 'required|string',
            'style_with' => 'required|string',
            'images' => 'required|array|min:4',
            'images.*' => 'required|mimes:jpeg,jpg,png|max:2048',
            'products.*.colors' => 'required|array|size:1',
            'products.*.sizes' => 'required|array|size:1',
        ],$messages);
        // dd( $request->all() );
        try {
            $blog =  $this->productService->storeProduct( $request );
            $notification = array(
                'message' => 'Product added successfully',
                'alert-type' => 'success'
            );
            return redirect()->route( 'show-product' )->with( $notification );
            // return back()->with( 'success', 'User created successfully!' );
        } catch ( ValidationException $e ) {
            return redirect()->back()->withErrors( $e->errors() )->withInput();
        } catch ( Exception $exception ) {
            return $exception->getMessage();

        }
    }

    public function edit( $slug ) {
        try {
            $products = $this->productService->editProduct( $slug );
            // dd( $products );
            $colors = $this->productService->getColors();
            // dd($colors);
            $sizes = $this->productService->getSizes();
            $quantities = $products->quantities;
            $data = [];
            foreach ( $quantities as $index => $quantity ) {
                $color = Color::where( 'id', $quantity[ 'color_id' ] )->first();
                $size = Size::where( 'id', $quantity[ 'size_id' ] )->first();
                $pair = [
                    'color' => $color,
                    'size' => $size,
                    'quantity'=>$quantity->product_quantity,
                ];
                $data[] = $pair;
            }
            // dd($data);
            // $descriptions = $this->productService->getProductDescription( $products );
            $category = Category::where( 'id', $products->category_id )->first();
            $cat = Category::all();
            return view( 'dashboard.WebsiteManagement.Products.add-new-product1', compact( 'products', 'cat', 'category','data' ,'colors','sizes') );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }

    public function update( Request $request, $slug ) {
        $messages = [
            'products.*.colors.size' => 'You can only select one color per record.',
            'products.*.sizes.size' => 'You can only select one size per record.',
        ];
        $request->validate( [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'shipping_returns' => 'required|string',
            'style_with' => 'required|string',
            // 'images' => 'required|array|min:4',
            // 'images.*' => 'required|mimes:jpeg,jpg,png|max:2048',
            'products.*.colors' => 'required|array|size:1',
            'products.*.sizes' => 'required|array|size:1',
        ],$messages);
        try {
            $users = $this->productService->updateProduct( $request, $slug );
            $notification = array(
                'message' => 'Product updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route( 'show-product' )->with( $notification );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }

    public function destroy( $slug ) {
        // dd( $slug );
        try {
            $products = $this->productService->deleteProduct( $slug );
            return response()->json( [
                'success'=>true,
                'message'=>'Product deleted successfully',
                'product'=>$products,
            ] );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }
    public function validatePromoCode(Request $request) {
        try {
            $request->validate([
                'promo_code' => 'required|string',
            ]);
            $promoCode = $this->productService->validatePromo($request);
            return response()->json([
                'success' => true,
                'promoCode' => $promoCode,
            ]);
        } catch (HttpResponseException $exception) {
            return $exception->getResponse();
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
