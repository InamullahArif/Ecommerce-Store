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
        </ul>
    </div>
</div>
<!-- breadcrumb end -->

<main id="MainContent" class="content-for-layout">
    <div class="cart-page mt-100">
        <div class="container">
            <div class="cart-page-wrapper">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-12">
                        <table class="cart-table w-100">
                            <thead>
                                <tr>
                                    <th class="cart-caption heading_18">Product</th>
                                    <th class="cart-caption heading_18"></th>
                                    <th class="cart-caption text-center heading_18 d-none d-md-table-cell">Quantity</th>
                                    <th class="cart-caption text-end heading_18">Price</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                <!-- Cart items will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="cart-total-area">
                            <h3 class="cart-total-title d-none d-lg-block mb-0">Cart Totals</h3>
                            <div class="cart-total-box mt-4">
                                <div class="subtotal-item subtotal-box">
                                    <h4 class="subtotal-title">Subtotals:</h4>
                                    <p class="subtotal-value" id="cart-subtotal">$0.00</p>
                                </div>
                                <div class="subtotal-item shipping-box">
                                    <h4 class="subtotal-title">Shipping:</h4>
                                    <p class="subtotal-value" id="cart-shipping">$10.00</p>
                                </div>
                                <div class="subtotal-item discount-box">
                                    <h4 class="subtotal-title">Discount:</h4>
                                    <p class="subtotal-value" id="cart-discount">$0.00</p>
                                </div>
                                <hr />
                                <div class="subtotal-item discount-box">
                                    <h4 class="subtotal-title">Total:</h4>
                                    <p class="subtotal-value" id="cart-total">$0.00</p>
                                </div>
                                <p class="shipping_text">Shipping & taxes calculated at checkout</p>
                                <div class="d-flex justify-content-center mt-4" id="checkout-btn-container">
                                    <a id="checkout-btn" href="/checkout" class="position-relative btn-primary text-uppercase">
                                        Proceed to checkout
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
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <script>
  $(document).ready(function() {
    function loadCartPage() {
        // Get cart items from local storage
        var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

        // Get cart containers
        var $cartItems = $('#cart-items');
        var $cartSubtotal = $('#cart-subtotal');
        var $cartShipping = $('#cart-shipping');
        var $cartDiscount = $('#cart-discount');
        var $cartTotal = $('#cart-total');
        // var $checkoutBtn = $('#checkout-btn');
        // var $checkoutBtnContainer = $('#checkout-btn-container');
        var $cartTotalArea = $('.cart-total-area'); // Select the cart totals area
        // Clear the current cart items
        $cartItems.empty();

        var subtotal = 0;
        var shipping = parseFloat($cartShipping.text().replace('$', ''));
        var discount = parseFloat($cartDiscount.text().replace('$', ''));

        // Generate HTML for each cart item and append it to the container
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

        // Update cart totals
        $cartSubtotal.text(`$${subtotal.toFixed(2)}`);
        $cartTotal.text(`$${total.toFixed(2)}`);

        if (cart.length === 0) {
            $cartTotalArea.hide(); 
            $cartItems.append(
             `<p style="margin-top:20px;">Cart is empty.</p>`
            );
        } else {
            $cartTotalArea.show();
        }
        $('.dec-qty').on('click', function() {
            var index = $(this).data('index');
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
            }
        });

        $('.inc-qty').on('click', function() {
            var index = $(this).data('index');
            cart[index].quantity++;
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        });

        $('.product-remove').on('click', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        });
    }

    loadCartPage();
});

</script> --}}