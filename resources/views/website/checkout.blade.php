@extends('website.welcome')
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="/">Home</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.4">
                            <path
                                d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                fill="#000" />
                        </g>
                    </svg>
                </li>
                <li>Cart</li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.4">
                            <path
                                d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                fill="#000" />
                        </g>
                    </svg>
                </li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <main id="MainContent" class="content-for-layout">
        <div class="checkout-page mt-100">
            <div class="container">
                <div class="checkout-page-wrapper">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                            <div class="section-header mb-3">
                                <h2 class="section-heading">Check out</h2>
                            </div>

                            <div class="checkout-progress overflow-hidden">
                                <ol class="checkout-bar px-0">
                                    <li class="progress-step step-done"><a href="/cart">Cart</a></li>
                                    <li class="progress-step step-active"><a href="/checkout">Shipping Details</a></li>
                                    {{-- <li class="progress-step step-todo"><a href="checkout.html">Shipping</a></li> --}}
                                    {{-- <li class="progress-step step-todo"><a href="checkout.html">Payment</a></li> --}}
                                    {{-- <li class="progress-step step-todo"><a href="checkout.html">Review</a></li> --}}
                                </ol>
                            </div>

                            {{-- <div class="checkout-user-area overflow-hidden d-flex align-items-center">
                                    <div class="checkout-user-img me-4">
                                        <img src="website/img/checkout/user.jpg" alt="img">
                                    </div>
                                    <div class="checkout-user-details d-flex align-items-center justify-content-between w-100">
                                        <div class="checkout-user-info">
                                            <h2 class="checkout-user-name">Susan Gardner</h2>
                                            <p class="checkout-user-address mb-0">2752 avenue Royale, Quebec, G1R 2B2, Canada</p>
                                        </div>
                                        
                                        <a href="#" class="edit-user btn-secondary">EDIT PROFILE</a>
                                    </div>
                                </div> --}}
                            <form
                                class="shipping-address-form common-form" id="shippingForm">
                                @csrf
                                <input type="hidden" name="promo_code" id="hidden_promo"/>
                                <div class="shipping-address-area">
                                    <h2 class="shipping-address-heading pb-1">Shipping Details</h2>
                                    <div class="shipping-address-form-wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label" >First name</label>
                                                    <input type="text" name="first_name" class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='first_name'></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Last name</label>
                                                    <input type="text" name="second_name" class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='second_name'></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Email address</label>
                                                    <input type="email" name="email"  class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='email'></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Phone number</label>
                                                    <input type="text" name="phone_no" class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='phone_no'></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Country</label>
                                                    <select class="form-select" id="countrySelect" name="country">
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="United States of America">USA</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Mexico">Mexico</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">City</label>
                                                    <select class="form-select" id="city-select" name="city">
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label" >Zip code</label>
                                                    <input type="text" name="zip_code" class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='zip_code'></span>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label" >Address</label>
                                                    <input type="text"  name="shipping_address" id="shippingAddress1" class="required"/>
                                                </fieldset>
                                            <span style="display:none;color:red" id='shipping_address'></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shipping-address-area billing-area">
                                    <h2 class="shipping-address-heading pb-1">Billing address</h2>
                                    <div class="form-checkbox d-flex align-items-center mt-4">
                                        <input class="form-check-input mt-0" type="checkbox" id="sameAsShipping" style="width:20px;height:20px;" class="required">
                                        <label class="form-check-label ms-2" for="sameAsShipping">
                                            Same as shipping address
                                        </label>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12 shipping-address-form common-form">
                                        <fieldset>
                                            <label class="label" >Billing Address</label>
                                            <input type="text" name="billing_address" id="billingAddress1" class="required"/>
                                        </fieldset>
                                        <span style="display:none;color:red" id='billing_address'></span>
                                    </div>
                                </div>
                                <div class="shipping-address-area billing-area">
                                    <div class="payment-method mt-2 mb-2">
                                        <h2 class="shipping-address-heading pb-1">Payment Method</h2>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method" id="cashOnDelivery" value="cod" checked style="width:20px;height:20px;" class="required">
                                            <label class="form-check-label" for="cashOnDelivery">
                                                <i class="fas fa-money-bill"></i> <!-- Money Bill Icon -->
                                                Cash on Delivery
                                            </label>
                                        </div>
                                        {{-- <div class="form-check mt-2 mb-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="onlinePayment" value="online" style="width:20px;height:20px;">
                                            <label class="form-check-label" for="onlinePayment">
                                                <i class="far fa-credit-card"></i> <!-- Credit Card Icon -->
                                        <a href="/stripe">
                                                Pay Online
                                    </a>
                                            </label>
                                        </div> --}}
                                        <div class="form-check mt-2 mb-2">
                                            <a href="#" id="payOnlineLink" style="color:black;">
                                            <input class="form-check-input" type="radio" name="payment_method" id="onlinePayment" value="online" style="width:20px;height:20px;" class="required">
                                            <label class="form-check-label" for="onlinePayment">
                                                <i class="far fa-credit-card"></i> <!-- Credit Card Icon -->
                                                Pay Online
                                            </label>
                                        </a>
                                        </div>

                                    </div>
                                    
                                    <div
                                        class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                        <a href="/cart" class="checkout-page-btn minicart-btn btn-secondary">BACK TO
                                            CART</a>
                                        {{-- <a href="/checkout" class="checkout-page-btn minicart-btn btn-primary"
                                            id="place_order">PLACE
                                            ORDER</a> --}}
                                            <button type="button"  onclick="submitForm()" class="checkout-page-btn minicart-btn btn-primary">PLACE ORDER</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                            <div class="cart-total-area checkout-summary-area">
                                <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h4>

                                    <div id="minicart-items" class="minicart-items">
                                    </div>

                                    <div class="cart-total-box mt-4 bg-transparent p-0">
                                        <div class="subtotal-item subtotal-box">
                                            <h4 class="subtotal-title">Subtotals:</h4>
                                            <p class="subtotal-value" id="subtotal-value">$465.00</p>
                                        </div>
                                        <div class="subtotal-item shipping-box">
                                            <h4 class="subtotal-title">Shipping:</h4>
                                            <p class="subtotal-value" id="shipping-value">$10.00</p>
                                        </div>
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Discount:</h4>
                                            <p class="subtotal-value" id="discount-value">$0.00</p>
                                        </div>
                                        <hr />
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Total:</h4>
                                            <p class="subtotal-value" id="total-value">$1000.00</p>
                                        </div>


                                        <div class="mt-4 checkout-promo-code">
                                            <input class="input-promo-code" type="text" placeholder="Promo code" id="inputPromo" />
                                            <span style="display:none;color:red;margin-top:8px;" id='promo_span'></span>
                                            <a
                                                class="btn-apply-code position-relative btn-secondary text-uppercase mt-3" id="promoCode">
                                                Apply Promo Code
                                            </a>
                                        </div>
                                    </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="loader" style="display:none">
        <div class="spinner-border text-primary" role="status" >
            <span class="sr-only">Loading...</span>
        </div>
        <div class="mt-3">
            <p>Please wait while we process your order ....</p>
        </div>
    </div>
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<style>
    #place_order[disabled] {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }
    .payment-method {
    margin-top: 20px;
}

.form-check {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.form-check-input {
    margin-right: 10px;
}
 .form-check-input[type="radio"] {
        width: 20px;
        height: 20px;
        appearance: none; /* Remove default appearance */
        -webkit-appearance: none; /* Remove default appearance for Safari/Chrome */
        -moz-appearance: none; /* Remove default appearance for Firefox */
        border: 2px solid #000; /* Black border */
        border-radius: 50%; /* Circular shape */
        outline: none; /* Remove outline */
        transition: border-color 0.3s ease-in-out; /* Smooth transition */
        cursor: pointer; /* Pointer cursor */
    }

    /* Custom styles for the radio button when checked */
    .form-check-input[type="radio"]:checked {
        border-color: #000; /* Black border when checked */
    }

    /* Adjust font size for the payment method labels */
    .form-check-label {
        font-size: 16px; /* Increase font size */
        margin-left: 10px; /* Add some margin for spacing */
    }

</style>
{{-- <script>
<script src="{{ asset('website/js/checkout.js') }}"></script>
</script> --}}
{{-- <script>
  $(document).ready(function() {
    function loadCart() {
        var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
        var $cartItems = $('#cart-items');
        var $cartSubtotal = $('#cart-subtotal');
        var $cartShipping = $('#cart-shipping');
        var $cartDiscount = $('#cart-discount');
        var $cartTotal = $('#cart-total');
        var $cartTotalArea = $('.cart-total-area');
        $cartItems.empty();
        var subtotal = 0;
        var shipping = parseFloat($cartShipping.text().replace('$', ''));
        var discount = parseFloat($cartDiscount.text().replace('$', ''));
        cart.forEach(function(item, index) {
            var itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            var cartItemHTML = `
                <tr class="cart-item">
                    <td class="cart-item-media">
                        <div class="mini-img-wrapper">
                            <img class="mini-img" src="${item.image}" alt="img">
                        </div>                                    
                    </td>
                    <td class="cart-item-details">
                        <h2 class="product-title"><a href="#">${item.name}</a></h2>
                        <p class="product-vendor">${item.size} / ${item.color}</p>                                   
                    </td>
                    <td class="cart-item-quantity">
                        <div class="quantity d-flex align-items-center justify-content-between">
                            <button class="qty-btn dec-qty" data-index="${index}"><img src="{{asset('website/img/icon/minus.svg')}}" alt="minus"></button>
                            <input class="qty-input" type="number" name="qty" value="${item.quantity}" min="0">
                            <button class="qty-btn inc-qty" data-index="${index}"><img src="{{asset('website/img/icon/plus.svg')}}" alt="plus"></button>
                        </div>
                        <a href="#" class="product-remove mt-2" data-index="${index}">Remove</a>                           
                    </td>
                    <td class="cart-item-price text-end">
                        <div class="product-price">$${itemTotal.toFixed(2)}</div>                           
                    </td>                        
                </tr>
            `;
            $cartItems.append(cartItemHTML);
        });
        var total = subtotal + shipping - discount;
        $cartSubtotal.text(`$${subtotal.toFixed(2)}`);
        $cartTotal.text(`$${total.toFixed(2)}`);
    }

});

</script> --}}
{{-- <script>
    function getCartItems() {
        console.log('AAAAAAA');
        const cartItemsJSON = localStorage.getItem('cart');
        return cartItemsJSON ? JSON.parse(cartItemsJSON) : [];
    }
    function calculateTotals(items) {
        // console.log(items);
        const subtotal = items.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const shipping = 10; // Example fixed shipping cost
        const discount = 100; // Example fixed discount
        const total = subtotal + shipping - discount;

        return { subtotal, shipping, discount, total };
    }
    function displayTotals(totals) {
        console.log(totals);
        document.getElementById('subtotal-value').innerText = `$${totals.subtotal.toFixed(2)}`;
        document.getElementById('shipping-value').innerText = `$${totals.shipping.toFixed(2)}`;
        document.getElementById('discount-value').innerText = `$${totals.discount.toFixed(2)}`;
        document.getElementById('total-value').innerText = `$${totals.total.toFixed(2)}`;
    }
    // Function to display cart items
    function displayCartItems(items) {
        // console.log('here');
        const minicartItemsContainer = document.getElementById('minicart-items');
        minicartItemsContainer.innerHTML = '';
        // console.log(items);
        items.forEach(item => {
            const itemHTML = `
                <div class="minicart-item d-flex">
                    <div class="mini-img-wrapper">
                        <img class="mini-img" src="${item.image}" alt="img">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title">${item.name}</h2>
                        <p class="product-vendor">$${item.price} x ${item.quantity}</p>
                    </div>
                </div>
            `;
            minicartItemsContainer.insertAdjacentHTML('beforeend', itemHTML);
        });
    }

    // Fetch and display items on page load
    document.addEventListener('DOMContentLoaded', () => {
        const cartItems = getCartItems();
        displayCartItems(cartItems);
        const totals = calculateTotals(cartItems);
        displayTotals(totals);
    });
</script> --}}

