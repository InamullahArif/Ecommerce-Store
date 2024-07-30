@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>View Order</h3>
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
                                <div class="text-tiny">View order</div>
                            </li>
                        </ul>
                    </div>
                    <div class="wg-box">
                        <div class="order-container" style="display: flex; justify-content: space-between; align-items: center;">
                            <fieldset class="name mb-24" style="margin: 0;">
                                <div class="body-title mb-2" style="font-size: 22px">Order ID</div>
                                <p style="font-size: 17px; padding-top: 5px;">{{ $orders->order_id }}</p>
                            </fieldset>
                            <a class="tf-button w180" href="{{ route('show-order') }}" style="margin-left: auto;">Back</a>
                        </div>
                        
                        
                        <div>
                            <form class="tf-section-2 form-add-product" id="viewOrder" name="viewOrder">
                                @csrf
                                @php
                                    $data = $orders->data;
                                    $data = json_decode($data, true);
                                    $data = json_decode($data, true);
                                @endphp
                                @foreach ($data as $order)
                                    @php
                                        $color = App\Models\Color::find($order['color']);
                                        $size = App\Models\Size::find($order['size']);
                                    @endphp
                                    <div class="wg-box">
                                        <fieldset class="name mb-24">
                                            <div class="body-title mb-10" style="font-size: 17px">Product Name</div>
                                            <input class="flex-grow" type="text" placeholder="Name"
                                                @if (isset($order['name'])) value="{{ $order['name'] }}" 
                                                        @else value="{{ old('name') }}" @endif
                                                name="name" tabindex="0" aria-required="true"
                                                style="margin-bottom: 6px;font-size:15px;">
                                            @error('name')
                                                <span
                                                    style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="name mb-24">
                                            <div class="body-title mb-10" style="font-size: 17px">Product Quantity</div>
                                            <input class="flex-grow" type="text" placeholder="Quantity"
                                                @if (isset($order['quantity'])) value="{{ $order['quantity'] }}" 
                                                        @else value="{{ old('quantity') }}" @endif
                                                name="quantity" tabindex="0" aria-required="true"
                                                style="margin-bottom: 6px;font-size:15px;" readonly>
                                            @error('quantity')
                                                <span
                                                    style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        <fieldset class="name mb-24">
                                            <div class="body-title mb-2" style="font-size: 17px">Product Price</div>
                                            <input class="flex-grow" type="text" placeholder="Price"
                                                @if (isset($order['price'])) value="{{ $order['price'] }}" 
                                                        @else value="{{ old('price') }}" @endif
                                                name="price" tabindex="0" aria-required="true"
                                                style="margin-bottom: 6px;font-size:15px;" readonly>
                                            @error('price')
                                                <span
                                                    style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                            @enderror
                                        </fieldset>
                                        </fieldset>
                                        <fieldset>
                                            <div class="body-title mb-10" style="font-size: 17px">Product Image</div>
                                            <div class="upload-image mb-16">
                                                @if (isset($order['image']))
                                                    <img src="{{ asset($order['image'] ?? '') }}" alt="Product Image"
                                                        style="width:150px;height:auto">
                                                @endif
                                            </div>
                                        </fieldset>
                                        <fieldset class="description mb-24">
                                            <div class="body-title mb-10" style="font-size: 17px">Selected Color</div>
                                            <div class="flex-grow" style="margin-bottom: 6px">
                                                <div class="color-label">
                                                    <div class="color-circle"
                                                        style="background-color: {{ $color->name }};"
                                                        title="{{ $color->name }}"></div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="description mb-24" style="font-size: 17px">
                                            <div class="body-title mb-10">Selected Size</div>
                                            <div class="flex-grow" style="margin-bottom: 6px">
                                                <label class="size-label" aria-label="Size {{ $size->name }}">
                                                    <input type="checkbox" name="products[0][sizes][]"
                                                        value="{{ $size->name }}" checked disabled>
                                                    <div class="size-box">{{ $size->name }}</div>
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                @endforeach
                                <div class="wg-box">
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Placed By</div>
                                        <input class="flex-grow" type="text" placeholder="Placed By"
                                            value="{{ $orders->first_name }}" name="placed_by" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Email</div>
                                        <input class="flex-grow" type="text" placeholder="Email"
                                            value="{{ $orders->email }}" name="email" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Phone Number</div>
                                        <input class="flex-grow" type="text" placeholder="Phone No."
                                            value="{{ $orders->phone_no }}" name="phone_no" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">City</div>
                                        <input class="flex-grow" type="text" placeholder="City"
                                            value="{{ $orders->city }}" name="city" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Country</div>
                                        <input class="flex-grow" type="text" placeholder="Country"
                                            value="{{ $orders->country }}" name="country" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Billing Address</div>
                                        <input class="flex-grow" type="text" placeholder="Billing Address"
                                            value="{{ $orders->billing_address }}" name="billing_address" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>


                                </div>
                                <div class="wg-box">
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Order Status</div>
                                        <input class="flex-grow" type="text" placeholder="Order Status"
                                            value="{{ $orders->status }}" name="order_status" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Payment Method</div>
                                        <input class="flex-grow" type="text" placeholder="Order Status"
                                            value="{{ $orders->payment_method }}" name="payment_method" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Zip Code</div>
                                        <input class="flex-grow" type="text" placeholder="Zip Code"
                                            value="{{ $orders->zip_code }}" name="zip_code" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Shipping Address</div>
                                        <input class="flex-grow" type="text" placeholder="Shipping Address"
                                            value="{{ $orders->shipping_address }}" name="shipping_address"
                                            tabindex="0" aria-required="true"
                                            style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Shipping Charges</div>
                                        <input class="flex-grow" type="text" placeholder="Shipping Charges"
                                            value="{{ '$10' }}" name="shipping_charges" tabindex="0"
                                            aria-required="true" style="margin-bottom: 6px;font-size:15px;" readonly>
                                    </fieldset>
                                    <fieldset class="name mb-24">
                                        <div class="body-title mb-2" style="font-size: 17px">Total Price</div>
                                        <input class="flex-grow" type="text" placeholder="Total Price"
                                            value="{{ '$' . $orders->total_price }}" name="total_price" tabindex="0"
                                            aria-required="true" readonly>
                                        @error('total_price')
                                            <span
                                                style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="bottom-page">
                        <div class="body-text">Copyright © 2024 Remos. Design with</div>
                        <i class="icon-heart"></i>
                        <div class="body-text">by <a
                                href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All
                            rights reserved.</div>
                    </div>
                </div>
            </div>
        @endsection
