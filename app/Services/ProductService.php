<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Order;
use App\Models\Promo;
use App\Models\Navbar;
use App\Models\Product;
use App\Models\Category;
use App\Models\Quantity;
use App\Models\Description;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductService
{
    public function getProducts($request, $perPage = 10)
    {
        $sort = $request->get('sort');
        $category = $request->get('categories');
        $stock = $request->get('in_stock');
        // dd($stock);
        // dd($cat->name);
        if (isset($stock) && $stock == 'In_Stock') {
            $filteredProducts = collect();
            $products = Product::all();
            foreach ($products as $product) {
                $quantities = $product->quantities;
                $sum = 0;
                foreach ($quantities as $quantity) {
                    $sum += $quantity->product_quantity;
                }
                if ($sum > 0) {
                    $filteredProducts->push($product);
                }
            }
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $filteredProducts->forPage($request->get('page', 1), $perPage),
                $filteredProducts->count(),
                $perPage,
                $request->get('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return [
                'products' => $products,
                'stock' => $stock,
            ];
        }
        if (isset($stock) && $stock == 'Out_of_Stock') {
            $filteredProducts = collect();
            $products = Product::all();
            foreach ($products as $product) {
                $quantities = $product->quantities;
                $sum = 0;
                foreach ($quantities as $quantity) {
                    $sum += $quantity->product_quantity;
                }
                if ($sum == 0) {
                    $filteredProducts->push($product);
                }
            }
            $products = new \Illuminate\Pagination\LengthAwarePaginator(
                $filteredProducts->forPage($request->get('page', 1), $perPage),
                $filteredProducts->count(),
                $perPage,
                $request->get('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return [
                'products' => $products,
                'stock' => $stock,
            ];
        }
        if (isset($category) && $category != 'All') {
            $products = Product::where('category_id', $category);
            // dd($products->get());
            $cat = Category::where('id', $category)->first();
            // dd($cat->name);
            $cat_name = $cat->name;
            // dd($cat_name);
            $products = $products->paginate($perPage)->withQueryString();
            return [
                'products' => $products,
                'category_name' => $cat_name
            ];
        }
        if ($sort) {
            switch ($sort) {
                case 'alphabetical_az':
                    $products = Product::orderBy('name', 'asc')->paginate($perPage)->withQueryString();
                    break;
                case 'alphabetical_za':
                    $products = Product::orderBy('name', 'desc')->paginate($perPage)->withQueryString();
                    break;
                case 'price_low_high':
                    $products = Product::orderBy('price', 'asc')->paginate($perPage)->withQueryString();
                    break;
                case 'price_high_low':
                    $products = Product::orderBy('price', 'desc')->paginate($perPage)->withQueryString();
                    break;
                case 'date_old_new':
                    $products = Product::orderBy('created_at', 'asc')->paginate($perPage)->withQueryString();
                    break;
                case 'date_new_old':
                    $products = Product::orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();
                    break;
                default:
                    $products = Product::paginate($perPage)->withQueryString();
                    break;
            }
            return $products;
        } else {
            $query = Product::with('description', 'quantities')->ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
            return $query->paginate($perPage)->withQueryString();
        }
        // dd($query->quantities);
    }

    public function getProductsDescriptions()
    {
        $descriptions = Description::all();
        return $descriptions;
    }

    public function storeProduct($request)
    {

        //   dd( $request[ 'products' ] );
        $products = $request['products'];
        $combinedData = [];

        foreach ($products as $item) {
            $colors = $item['colors'];
            $sizes = $item['sizes'];
            $quantities = $item['quantity'];

            // Ensure all arrays have the same length ( optional check )
            $length = min(count($colors), count($sizes), count($quantities));

            for ($i = 0; $i < $length; $i++) {
                $combinedData[] = [
                    'color' => $colors[$i],
                    'size' => $sizes[$i],
                    'quantity' => $quantities[$i]
                ];
            }
        }
        //   dd( $combinedData );
        $product = Product::create([
            'name' => $request->name,
            // 'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        $id = $product->id;
        foreach ($combinedData as $quantityData) {
            Quantity::create([
                'product_id' => $id,
                'color_id' => $quantityData['color'],
                'size_id' => $quantityData['size'],
                'product_quantity' => $quantityData['quantity'],
            ]);
        }

        $description = Description::create([
            'description' => $request->description,
            'shipping_returns' => $request->shipping_returns,
            'style_with' => $request->style_with,
            'product_id' => $id,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/product_images');
                $image->move($path, $imageName);
                $imageUrl = 'product_images/' . $imageName;
                $image = new Image(['name' => $imageUrl]);
                $product->images()->save($image);
            }
        } else {
            $imageUrl = 'product_images/product.jpg';
            $image = new Image(['name' => $imageUrl]);
            $product->images()->save($image);
        }
        return $product;
    }

    public function editProduct($slug)
    {
        $product = Product::with('images', 'description')->where('slug', $slug)->firstOrFail();
        $quantities = $product->quantities;
        if ($quantities) {
            $product['quantity'] = $quantities;
        }
        // dd($product);
        return $product;
    }

    public function getColors()
    {
        $colors = Color::all();
        return $colors;
    }

    public function getSizes()
    {
        $sizes = Size::all();
        return $sizes;
    }

    public function getProduct($slug)
    {
        // dd($slug);
        $product = Product::with('images', 'description')->where('slug', $slug)->firstOrFail();
        $quantities = $product->quantities;
        if ($quantities) {
            $product['quantity'] = $quantities;
        }
        $category = Category::find($product->category_id);
        if ($category) {
            $product['category'] = $category;
        }
        return $product;
    }
    public function getProductWeb($slug)
    {
        // dd($slug);
        $product = Product::with('images', 'description')->where('slug', $slug)->firstOrFail();
        $allProducts = Product::with('images', 'description')
            ->where('id', '!=', $product->id)
            ->get();
        $quantities = $product->quantities;
        if ($quantities) {
            $product['quantity'] = $quantities;
        }
        $category = Category::find($product->category_id);
        if ($category) {
            $product['category'] = $category;
        }
        if ($allProducts) {
            $product['allProducts'] = $allProducts;
        }
        return $product;
    }
    public function getProductDescription($product)
    {
        $description = Description::where('product_id', $product->id)->first();
        return $description;
    }

    public function getCategories()
    {
        $categories = Category::all();
        return $categories;
    }

    public function updateProduct($request, $slug)
    {
        // dd($request->all());
        $product = Product::with('images', 'description')->where('slug', $slug)->firstOrFail();
        // dd($product);
        // dd('here');

        $products = $request['products'];
        $combinedData = [];
        // dd($products);
        if (isset($products)) {
            foreach ($products as $item) {
                // dd('here');
                $colors = $item['colors'];
                $sizes = $item['sizes'];
                $quantities = $item['quantity'];

                // Ensure all arrays have the same length ( optional check )
                $length = min(count($colors), count($sizes), count($quantities));

                for ($i = 0; $i < $length; $i++) {
                    $combinedData[] = [
                        'color' => $colors[$i],
                        'size' => $sizes[$i],
                        'quantity' => $quantities[$i]
                    ];
                }
            }
        }

        $id = $product->id;
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->save();
        // dd('here');
        // dd($combinedData);
        // dd($combinedData[2]['quantity']);
        foreach ($product->quantities as $quantity) {
            $quantity->delete();
        }
        foreach ($combinedData as $index => $data) {
            // dd($data[$index]['quantity']);
            // dd('here');
            Quantity::updateOrCreate([
                'product_quantity' => $data['quantity'],
                'product_id' => $id,
                'color_id' => $data['color'],
                'size_id' => $data['size'],
            ]);
        }
        // dd('here');
        $description = Description::where('product_id', $product->id)->first();
        $description->description = $request['description'];
        $description->shipping_returns = $request['shipping_returns'];
        $description->style_with = $request['style_with'];
        $description->save();
        // foreach()
        // dd($request->hasFile( 'images' ));
        // dd($request->hasFile( 'images' ));
        // if ( $request->hasFile( 'images' ) ) {
        //     foreach ( $request->file( 'images' ) as $image ) {
        //         $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        //         $path = public_path( '/product_images' );
        //         $image->move( $path, $imageName );
        //         $imageUrl = 'product_images/' . $imageName;
        //         $image = new Image( [ 'name' => $imageUrl ] );
        //         $product->images()->save( $image );
        //     }
        // } else {
        //     $imageUrl = 'product_images/product.jpg';
        //     $image = new Image( [ 'name' => $imageUrl ] );
        //     $product->images()->save( $image );
        // }
        // dd($product->images);
        // dd($request->hasFile('image'));
        if ($request->hasFile('images')) {
            // dd('here');
            // $imageFile = $request->file('image');
            if (($product->images) == null) {
                // dd('here');

                foreach ($request->file('images') as $image) {
                    // dd('here');

                    $imageName = time() . '.' . $request->image->extension();
                    $request->images->move(public_path('product_images'), $imageName);
                    $imageUrl = 'product_images/' . $imageName;
                    $image = new Image(['name' => $imageUrl]);
                    $product->images()->save($image);
                }
            } else {
                // dd('here1');
                foreach ($product->images as $product_image) {
                    // dd($product_image->name);

                    if ($product_image->name != 'product_images/product.jpg') {
                        // dd('here3');
                        if (File::exists(public_path($product_image->name))) {
                            File::delete(public_path($product_image->name));
                        }
                    }
                    // dd('here4');
                    $product_image->delete();
                }
                foreach ($request->file('images') as $image) {
                    // dd('here');
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $path = public_path('/product_images');
                    $image->move($path, $imageName);
                    $imageUrl = 'product_images/' . $imageName;
                    $image = new Image(['name' => $imageUrl]);
                    $product->images()->save($image);
                }
            }
            // dd('here');

        }
        return $product;
    }

    public function deleteProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        if ($product) {
            $product->delete();
            return $product;
        }
    }
    public function saveShippingDetails($request, $lastSegment)
    {
        // dd($lastSegment);
        $cartItems = json_decode($request->cart, true);
        $quantities = Quantity::where('product_id', $cartItems[0]['id'])
            ->where('size_id', $cartItems[0]['size'])
            ->where('color_id', $cartItems[0]['color'])
            ->first();
        // dd((int) $quantities->product_quantity,$cartItems[0]['quantity']);
        $db_quantity = (int) $quantities->product_quantity;
        $updateQuantity = $db_quantity - $cartItems[0]['quantity'];
        $resultStr = (string) $updateQuantity;
        $quantities->product_quantity = $resultStr;
        $quantities->save();
        // dd($quantities);
        $jsonData = json_encode($request->cart, true);
        // dd($request->all());
        $order = new Order();
        if ($lastSegment === 'stripe') {
            $order->status = 'paid';
            $order->payment_method = 'online';
        } else {
            $order->payment_method = 'cod';
        }
        $order->first_name = $request->first_name;
        $order->second_name = $request->second_name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->zip_code = $request->zip_code;
        $order->shipping_address = $request->shipping_address;
        $order->billing_address = $request->billing_address;
        // $order->payment_method = $request->payment_method;
        $order->total_price = $request->total_price;
        $order->data = $jsonData;
        $uniqueNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $order->order_id = 'ORD-' . $uniqueNumber;
        $order->save();
        return $order;
    }
    public function validatePromo($request)
{
    $promo = Promo::where('promo_code', $request['promo_code'])->first();

    if (!$promo) {
        throw new HttpResponseException(response()->json(['error' => 'Promo code does not exist'], 404));
    }

    $validUpto = Carbon::parse($promo->valid_upto);

    if (Carbon::now()->lessThanOrEqualTo($validUpto)) {
        return $promo;
    } else {
        throw new HttpResponseException(response()->json(['error' => 'Promo code has expired'], 400));
    }
}
}
