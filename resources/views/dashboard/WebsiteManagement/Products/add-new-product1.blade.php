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
                                <a href="/"><div class="text-tiny">Dashboard</div></a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <a href="#"><div class="text-tiny">Ecommerce</div></a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">{!! __(!empty($products) ? 'Update Product' : 'Add New Product') !!}</div>
                            </li>
                        </ul>
                    </div>
                    <form class="tf-section-2 form-add-product" id="addProduct" name="addProduct" method="POST"
                          enctype="multipart/form-data"
                          action="{{ !empty($products['slug']) ? route('update-product', $products['slug']) : route('store-product') }}">
                        @csrf
                        <div class="wg-box">
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">Product Name</div>
                                <input type="hidden" name="product_id" id="product_id" @if(isset($products['slug'])) value="{{ $products['slug'] }}" @endif>
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
                            <div class="gap22 cols">
                                <fieldset class="name">
                                    <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
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
                            </div>
                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Description</div>
                                <textarea class="flex-grow" placeholder="Description" name="description" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($products->description->description)){{$products->description->description }}@else{{ old('description') }}@endif</textarea>
                                @error('description')
                                <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Shipping Returns</div>
                                <textarea class="flex-grow" placeholder="Shipping returns policy" name="shipping_returns" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($products->description->shipping_returns)){{ $products->description->shipping_returns }}@else{{ old('shipping_returns') }}@endif</textarea>
                                @error('shipping_returns')
                                <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="description mb-24">
                                <div class="body-title mb-10">Style With</div>
                                <textarea class="flex-grow" placeholder="Style With Policy" name="style_with" tabindex="0" aria-required="true" style="margin-bottom: 6px">@if (isset($products->description->style_with)){{ $products->description->style_with }}@else{{ old('style_with') }}@endif</textarea>
                                @error('style_with')
                                <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="wg-box">
                            <fieldset>
                                <div class="body-title mb-10">Upload images</div>
                                <div class="upload-image mb-16">
                                    <div class="item">
                                        <div id="imagePreviews">
                                            @if(isset($products->images))
                                                @foreach($products->images as $image)
                                                    <img src="{{ asset($image->name ?? '') }}" alt="Product Image" style="width:110px;height:auto">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item up-load">
                                        <label class="uploadfile" for="myFile">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                            <input type="file" id="myFile" name="images[]" accept="image/*" multiple onchange="previewImage(event)">
                                        </label>
                                    </div>
                                </div>

                                <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details</div>
                                @error('images')
                                <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            {{-- <div id="form-repeater-container">
                                <div class="form-repeater">
                                    @php
                                        $data = isset($data) ? $data : [[]];
                                    @endphp
                                    @foreach($data as $outer_index=>$info)
                                    <fieldset class="description mb-24">
                                        <div class="body-title mb-10">Colors</div>
                                        <div class="flex-grow" style="margin-bottom: 6px">
                                            @if(isset($colors) &&!$colors->isEmpty())
                                                @foreach ($colors as $index => $color)
                                                    <label class="color-label">
                                                        <input type="checkbox" name="products[0][colors][]" value="{{ $color->id }}"
                                                            @if(is_array(old('products.0.colors')) && in_array($color->id, old('products.0.colors'))) checked
                                                            @elseif(isset($info['color']) && $info['color']->id == $color->id) checked
                                                            @endif>
                                                        <div class="color-circle" style="background-color: {{ $color->name }};" title="{{ $color->name }}"></div>
                                                    </label>
                                                @endforeach
                                            @else 
                                                <div class="body-text">No colors available.</div>
                                            @endif
                                        </div>
                                        
                                        @error('products.0.colors')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="description mb-24">
                                        <div class="body-title mb-10">Sizes</div>
                                        <div class="flex-grow" style="margin-bottom: 6px">
                                            @if(isset($sizes) && !$sizes->isEmpty())
                                                @foreach ($sizes as $index=> $size)
                                                    <label class="size-label">
                                                        <input type="checkbox" name="products[0][sizes][]" value="{{ $size->id }}"
                                                            @if(is_array(old('products.0.sizes')) && in_array($size->id, old('products.0.sizes'))) checked
                                                            @elseif(isset($info['size']) && $info['size']->id ==  $size->id) checked
                                                            @endif>
                                                        <div class="size-box">{{ $size->name }}</div>
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="body-text">No sizes available.</div>
                                            @endif
                                        </div>
                                        @error('products.0.sizes')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-10">Product Quantity</div>
                                        <input class="flex-grow" type="text" placeholder="Quantity"
                                               value="@if(is_array(old('products.0.quantity')))
                                                   {{ implode(',', old('products.0.quantity')) }}
                                               @elseif(isset($data[$outer_index]['quantity']))
                                                   {{ $data[$outer_index]['quantity'] }}
                                               @else
                                                   {{ old('products.0.quantity') }}
                                               @endif"
                                               name="products[0][quantity][]" tabindex="0" aria-required="true"
                                               style="margin-bottom: 6px">
                                        @error('products.0.quantity')
                                            <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <button type="button" class="remove-form-repeater tf-button style-1" onclick="removeRepeaterItem(this)">Remove</button>
                                    @endforeach
                                </div>
                            </div>
                            <button type="button" id="add-form-repeater" class="tf-button style-1 w-full" onclick="addRepeaterItem()">Add More</button>
                            <button class="tf-button style-1 w-full" type="submit">{!! __(!empty($products) ? 'Update' : 'Save') !!}</button> --}}
                            <div id="form-repeater-container">
                                @php
                                    $data = isset($data) ? $data : [[]];
                                @endphp
                                @foreach($data as $outer_index => $info)
                                <div class="form-repeater">
                                    <fieldset class="description mb-24">
                                        <div class="body-title mb-10">Colors</div>
                                        <div class="flex-grow" style="margin-bottom: 6px">
                                            @if(isset($colors) && !$colors->isEmpty())
                                                @foreach ($colors as $color)
                                                    <label class="color-label">
                                                        <input type="checkbox" class="color-checkbox" name="products[{{ $outer_index }}][colors][]" value="{{ $color->id }}"
                                                            @if(is_array(old('products.'.$outer_index.'.colors')) && in_array($color->id, old('products.'.$outer_index.'.colors'))) checked
                                                            @elseif(isset($info['color']) && $info['color']->id == $color->id) checked
                                                            @endif>
                                                        <div class="color-circle" style="background-color: {{ $color->name }};" title="{{ $color->name }}"></div>
                                                    </label>
                                                @endforeach
                                            @else 
                                                <div class="body-text">No colors available.</div>
                                            @endif
                                        </div>
                                        @error('products.'.$outer_index.'.colors')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="description mb-24">
                                        <div class="body-title mb-10">Sizes</div>
                                        <div class="flex-grow" style="margin-bottom: 6px">
                                            @if(isset($sizes) && !$sizes->isEmpty())
                                                @foreach ($sizes as $size)
                                                    <label class="size-label">
                                                        <input type="checkbox" class="size-checkbox" name="products[{{ $outer_index }}][sizes][]" value="{{ $size->id }}"
                                                            @if(is_array(old('products.'.$outer_index.'.sizes')) && in_array($size->id, old('products.'.$outer_index.'.sizes'))) checked
                                                            @elseif(isset($info['size']) && $info['size']->id == $size->id) checked
                                                            @endif>
                                                        <div class="size-box">{{ $size->name }}</div>
                                                    </label>
                                                @endforeach
                                            @else
                                                <div class="body-text">No sizes available.</div>
                                            @endif
                                        </div>
                                        @error('products.'.$outer_index.'.sizes')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-10">Product Quantity</div>
                                        <input class="flex-grow" type="text" placeholder="Quantity"
                                            value="@if(is_array(old('products.'.$outer_index.'.quantity')))
                                                {{ implode(',', old('products.'.$outer_index.'.quantity')) }}
                                            @elseif(isset($data[$outer_index]['quantity']))
                                                {{ $data[$outer_index]['quantity'] }}
                                            @else
                                                {{ old('products.'.$outer_index.'.quantity') }}
                                            @endif"
                                            name="products[{{ $outer_index }}][quantity][]" tabindex="0" aria-required="true"
                                            style="margin-bottom: 6px">
                                        @error('products.'.$outer_index.'.quantity')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                    <button type="button" class="remove-form-repeater tf-button style-1" onclick="removeRepeaterItem(this)" style="display: {{ $outer_index === 0 ? 'none' : 'block' }};">Remove</button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-form-repeater" class="tf-button style-1 w-full" onclick="addRepeaterItem()">Add More</button>
                            <button class="tf-button style-1 w-full" type="submit">{!! __(!empty($products) ? 'Update' : 'Save') !!}</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
