@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>{!! __(!empty($products) ? 'Update Product' : 'Add New Product') !!}</h3>
                        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                            <li>
                                <a href="/">
                                    <div class="text-tiny">Dashboard</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="text-tiny">Product</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">{!! __(!empty($products) ? 'Update Product' : 'Add New Product') !!}</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="addProduct" name="addProduct" method="POST"
                        enctype="multipart/form-data"
                        action="{{ !empty($products['slug']) ? route('update-product', $products['slug']) : route('store-product') }}">
                        @csrf
                        <div class="wg-box">
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Product Name</div>
                                    <input type="hidden" name="product_id" id="product_id" @if(isset($products['slug'])) value={{$products['slug']}} @endif>
                                    <input class="flex-grow" type="text" placeholder="Name"
                                        @if (isset($products['name'])) value="{{ $products['name'] }}" 
                                                @else value="{{ old('name') }}" @endif
                                        name="name" tabindex="0" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('name')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Product Quantity</div>
                                    <input class="flex-grow" type="text" placeholder="Quantity"
                                        @if (isset($products['quantity'])) value="{{ $products['quantity'] }}" 
                                                @else value="{{ old('quantity') }}" @endif
                                        name="quantity" tabindex="0" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('quantity')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Description</div>
                                    <textarea class="flex-grow" placeholder="Description" name="description" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($descriptions->description)){{ $descriptions->description }}@else{{ old('description') }}@endif</textarea>
                                    @error('description')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Shipping Returns</div>
                                    <textarea class="flex-grow" placeholder="Shipping returns policy" name="shipping_returns" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($descriptions->shipping_returns)){{ $descriptions->shipping_returns }}@else{{ old('shipping_returns') }}@endif</textarea>
                                    @error('shipping_returns')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Style With</div>
                                    <textarea class="flex-grow" placeholder="Style With Policy" name="style_with" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($descriptions->style_with)){{ $descriptions->style_with }}@else{{ old('style_with') }}@endif</textarea>
                                    @error('style_with')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Product Price</div>
                                    <input class="flex-grow" type="text" placeholder="Price"
                                        @if (isset($products['price'])) value="{{ $products['price'] }}" 
                                                @else value="{{ old('price') }}" @endif
                                        name="price" tabindex="0" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('price')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Category</div>
                                    <select class="flex-grow" name="category_id" tabindex="0" aria-required="true" required>
                                        <option value="" disabled>Select a category</option>
                                        @foreach ($cat as $c)
                                            <option value="{{ $c->id }}"
                                                @if (isset($category) && ($category->name ? $category->name === $c->name : false)) selected @endif>
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                                </fieldset>
                                <fieldset class="image mb-24" style="margin-top: 10px">
                                    <div class="body-title mb-10">Product Image</div>
                                    <input type="file" name="image[]" accept="image/*" tabindex="0"
                                        aria-required="true" multiple>
                                    @error('image')
                                        <br></br>
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                {{-- {{dd($blogs->image->name)}} --}}
                                @if (isset($products->image->name))
                                    <img src="{{ asset($products->image->name ?? '') }}" alt="Blog Image"
                                        style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                @else
                                    <input type="hidden" name="image_url" value="{{ asset('product_images/product.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="bot">
                            <button class="tf-button w180" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
