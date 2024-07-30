@extends('dashboard.welcome')
@section('content')
    <!-- section-content-right -->
    <div class="section-content-right">
        <div class="main-content">
            <!-- main-content-wrap -->
            <div class="main-content-inner">
                <!-- main-content-wrap -->
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>View Product</h3>
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
                                    <div class="text-tiny">Ecommerce</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">View product</div>
                            </li>
                        </ul>
                    </div>
                    <!-- form-add-product -->
                    <form class="tf-section-2 form-add-product" id="viewProduct" name="viewProduct" method="POST"
                        enctype="multipart/form-data"
                        action="{{ !empty($products['slug']) ? route('update-product', $products['slug']) : route('store-product') }}">
                        @csrf
                        <div class="wg-box">
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">Product Name</div>
                                <input type="hidden" name="product_id" id="product_id"
                                    @if (isset($products['slug'])) value={{ $products['slug'] }} @endif>
                                <input class="flex-grow" type="text" placeholder="Name"
                                    @if (isset($products['name'])) value="{{ $products['name'] }}" 
                                                        @else value="{{ old('name') }}" @endif
                                    name="name" tabindex="0" aria-required="true" style="margin-bottom: 6px">
                                @error('name')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            {{-- <fieldset class="name mb-24">
                                            <div class="body-title mb-10">Product Quantity</div>
                                            <input class="flex-grow" type="text" placeholder="Quantity"
                                                @if (isset($products['quantity'])) value="{{ $products['quantity'] }}" 
                                                        @else value="{{ old('quantity') }}" @endif
                                                name="quantity" tabindex="0" aria-required="true"
                                                style="margin-bottom: 6px" readonly>
                                            @error('quantity')
                                                <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                            @enderror
                                        </fieldset> --}}
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">Product Price</div>
                                <input class="flex-grow" type="text" placeholder="Price"
                                    @if (isset($products['price'])) value="{{ $products['price'] }}" 
                                                        @else value="{{ old('price') }}" @endif
                                    name="price" tabindex="0" aria-required="true" style="margin-bottom: 6px" readonly>
                                @error('price')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <div class="gap22 cols">
                                <fieldset class="name">
                                    <div class="body-title mb-10">Category</div>
                                    <select class="flex-grow" name="category_id" tabindex="0" aria-required="true"
                                        required="" disabled>
                                        <option value="" disabled>Select a category</option>
                                        <option value="{{ $products->id }}"
                                            @if (isset($products['category']) && $products->category_id == $products['category_id']) selected @endif>
                                            {{ $products['category']->name ?? '--' }}
                                        </option>
                                    </select>
                                    <input type="hidden" name="category_id" value="{{ $products->category_id }}">
                                </fieldset>
                            </div>
                            {{-- {{dd($products->description->description)}} --}}
                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Description</div>
                                <textarea class="flex-grow" placeholder="Description" name="description" tabindex="0" aria-required="true"
                                    style="margin-bottom: 6px" readonly>
                                    @if (isset($products->description->description))
                                    {{$products->description->description }}@else{{ old('description') }}
                                    @endif
                                    </textarea>
                                @error('description')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Shipping Returns</div>
                                <textarea class="flex-grow" placeholder="Shipping returns policy" name="shipping_returns" tabindex="0"
                                    aria-required="true" style="margin-bottom: 6px" readonly>
                                @if (isset($products->description->shipping_returns))
                                {{ $products->description->shipping_returns }}@else{{ old('shipping_returns') }}
                                @endif
                                </textarea>
                                @error('shipping_returns')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Style With</div>
                                <textarea class="flex-grow" placeholder="Style With Policy" name="style_with" tabindex="0" aria-required="true"
                                    style="margin-bottom: 6px" readonly>
                                    @if (isset($products->description->style_with))
                                    {{ $products->description->style_with }}@else{{ old('style_with') }}
                                    @endif
                                    </textarea>
                                @error('style_with')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="wg-box">
                            {{-- <fieldset>
                                            <div class="body-title mb-10">Upload images</div>
                                            <div class="upload-image mb-16">
                                                <div class="item">
                                                    <img src="images/upload/upload-1.png" alt="">
                                                </div>
                                                <div class="item">
                                                    <img src="images/upload/upload-2.png" alt="">
                                                </div>
                                                <div class="item up-load">
                                                    <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                                        <input type="file" id="myFile" name="filename">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details</div>
                                        </fieldset> --}}
                            <fieldset>
                                {{-- {{dd($products->images)}} --}}
                                <div class="body-title mb-10">Upload images</div>
                                <div class="upload-image mb-16">
                                    <div class="item">
                                        <!-- Removed static img tags -->
                                        <div id="imagePreviews">
                                            @if (isset($products->images))
                                                @foreach ($products->images as $image)
                                                    <img src="{{ asset($image->name ?? '') }}" alt="Product Image"
                                                        style="width:110px;height:auto">
                                                @endforeach
                                            @endif
                                        </div> <!-- Container for image previews -->
                                    </div>
                                    <div class="item up-load">
                                        <label class="uploadfile" for="myFile">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>

                                            <span class="text-tiny">Drop your images here or select <span
                                                    class="tf-color">click to browse</span></span>
                                            {{-- <input type="file" id="myFile" name="images[]" accept="image/*" multiple
                                                onchange="previewImage(event)" readonly> --}}
                                        </label>
                                    </div>
                                </div>
                                <div class="body-text">You need to add at least 4 images. Pay attention to the quality of
                                    the pictures you add, comply with the background color standards. Pictures must be in
                                    certain dimensions. Notice that the product shows all the details</div>
                            </fieldset>
                            @if (isset($data))
                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Selected Colors</div>
                                    <div class="flex-grow" style="margin-bottom: 6px">
                                        <div class="color-label">
                                            @foreach ($data as $index => $item)
                                                <div class="color-circle"
                                                    style="background-color: {{ $item['color']->name }};"
                                                    title="{{ $item['color']->name }}"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Selected Sizes</div>
                                    <div class="flex-grow" style="margin-bottom: 6px">
                                        @foreach ($data as $index => $sizeArray)
                                            <label class="size-label" aria-label="Size {{ $sizeArray['size']->id }}">
                                                <input type="checkbox" name="products[0][sizes][]" value="{{ $sizeArray['size']->id }}" checked disabled>
                                                <div class="size-box">{{ $sizeArray['size']->name }}</div>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                                
                                
                            @else
                            
                            @endif

                            {{--                                         
                                        <fieldset class="description mb-24">
                                            <div class="body-title mb-10">Selected Sizes</div>
                                            <div class="flex-grow" style="margin-bottom: 6px">
                                                @if (isset($selectedSizes) && !empty($selectedSizes))
                                                    @foreach ($selectedSizes as $sizeId)
                                                        <div class="size-label">
                                                            <span>{{ getSizeNameById($sizeId) }}</span>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="body-text">No sizes selected.</div>
                                                @endif
                                            </div>
                                        </fieldset>
                                        
                                        <fieldset class="name mb-24">
                                            <div class="body-title mb-10">Product Quantity</div>
                                            <div class="flex-grow" style="margin-bottom: 6px">
                                                @if (isset($products['quantity']))
                                                    <span>{{ $products['quantity'] }}</span>
                                                @else
                                                    <div class="body-text">Quantity not specified.</div>
                                                @endif
                                            </div>
                                        </fieldset> --}}
                            {{-- @endforeach --}}
                            <div class="cols gap10">
                                {{-- <button class="tf-button w-full" type="submit">Back</button> --}}
                                <a class="tf-button w180" href="{{ route('show-product') }}">Back
                                    {{-- <button class="tf-button w180" type="submit"> Back</button> --}}
                                </a>
                                {{-- <button class="tf-button style-1 w-full" type="submit">Save product</button> --}}
                                {{-- <a href="#" class="tf-button style-2 w-full">Schedule</a> --}}
                            </div>
                        </div>
                    </form>
                    <!-- /form-add-product -->
                </div>
                <!-- /main-content-wrap -->
            </div>
            <!-- /main-content-wrap -->
            <!-- bottom-page -->
            <div class="bottom-page">
                <div class="body-text">Copyright © 2024 Remos. Design with</div>
                <i class="icon-heart"></i>
                <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All
                    rights reserved.</div>
            </div>
            <!-- /bottom-page -->
        </div>
        <!-- /main-content -->
    </div>
    <!-- /section-content-right -->
@endsection
