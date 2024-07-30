@extends('website.welcome')
@section('content')
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
                <li><a href="/checkout">Checkout</a></li>
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
                <li>Payment Details</li>
            </ul>
        </div>
    </div>

    <main id="MainContent" class="content-for-layout">
        <div class="checkout-page mt-100">
            <div class="container">
                <div class="checkout-page-wrapper">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                            <div class="section-header mb-3">
                                <h2 class="section-heading">Payment Details</h2>
                            </div>
                            <form class="shipping-address-form common-form require-validation" role="form"
                                action="{{ route('stripe.post') }}" method="post" id="payment-form">
                                @csrf
                                <div class="shipping-address-area">
                                    <h2 class="shipping-address-heading pb-1">Payment Details</h2>
                                    <div class="shipping-address-form-wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Name on Card</label>
                                                    <input type="text" id="cardholder-name" name="card_name"
                                                        class="form-control" />
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-12">
                                                <fieldset>
                                                    <label class="label">Card Details</label>
                                                    <div id="card-element"></div>
                                                </fieldset>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-md-12 error form-group hide' style="display:none">
                                                    <div class='alert-danger alert'>Please correct the errors and try again.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12" style="margin-top:25px">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit"
                                                    id="payButton">Pay Now ($100)</button>
                                                <input type="hidden" name="payment_method" id="payment-method">
                                                <input type="hidden" name="billing_address" id="billing_address" />
                                                <input type="hidden" name="city" id="city" />
                                                <input type="hidden" name="email" id="email" />
                                                <input type="hidden" name="country" id="country" />
                                                <input type="hidden" name="first_name" id="first_name" />
                                                {{-- <input type="hidden" name="payment_method" id="payment_method"/> --}}
                                                <input type="hidden" name="phone_no" id="phone_no" />
                                                <input type="hidden" name="second_name" id="second_name" />
                                                <input type="hidden" name="shipping_address" id="shipping_address" />
                                                <input type="hidden" name="zip_code" id="zip_code" />
                                                <input type="hidden" name="amount" id="amount" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                            <div class="cart-total-area checkout-summary-area">
                                <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h4>
                                    <div id="minicart-items" class="minicart-items"></div>
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
            <p>Please wait while we process your payment ....</p>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        // console.log('jere');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        var shippingFormData = JSON.parse(localStorage.getItem('shippingFormData'));
        console.log(shippingFormData.discount); 
        // $('#total-value1').text(`$${shippingFormData.amount.toFixed(2)}`);
        $('#discount-value').text(`$${shippingFormData.discount}`);
        var cart = JSON.parse(localStorage.getItem('cart'));
        // console.log(shippingFormData); return;
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            $('#loader').show();
            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: document.getElementById('cardholder-name').value,
                },
            }).then(function(result) {
                if (result.error) {
                    console.log(result.error.message);
                } else {
                    document.getElementById('payment-method').value = result.paymentMethod.id;
                    var shippingFormData = JSON.parse(localStorage.getItem('shippingFormData'));
                    var user_email = shippingFormData.email;
                    document.getElementById('first_name').value = shippingFormData.first_name;
                    document.getElementById('second_name').value = shippingFormData.second_name;
                    document.getElementById('email').value = shippingFormData.email;
                    document.getElementById('phone_no').value = shippingFormData.phone_no;
                    document.getElementById('country').value = shippingFormData.country;
                    document.getElementById('city').value = shippingFormData.city;
                    document.getElementById('zip_code').value = shippingFormData.zip_code;
                    document.getElementById('shipping_address').value = shippingFormData
                        .shipping_address;
                    document.getElementById('billing_address').value = shippingFormData
                        .billing_address;
                    document.getElementById('amount').value = shippingFormData.amount;
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "10000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.success('Order placed successfully');
                    form.submit();
                    var email = shippingFormData.email;
                    var first_name = shippingFormData.first_name;
                    // var amount = shippingFormData.totalPrice + 10;
                    var amount = parseFloat(shippingFormData.amount);
                    setTimeout(() => {
                        localStorage.removeItem('shippingFormData');
                    }, 1000);
                    var totalPrice = 0;
                    // if (cart && cart.length > 0) {
                    //     totalPrice = cart.reduce(function(acc, item) {
                    //         return acc + (item.quantity * item.price);
                    //     }, 0);
                    // }
                    // totalPrice = totalPrice + 10;
                    var formData = $('#shippingForm').serialize();
                    formData += '&first_name=' + shippingFormData.first_name;
                    formData += '&second_name=' + shippingFormData.second_name;
                    formData += '&email=' + shippingFormData.email;
                    formData += '&phone_no=' + shippingFormData.phone_no;
                    formData += '&country=' + shippingFormData.country;
                    formData += '&city=' + shippingFormData.city;
                    formData += '&zip_code=' + shippingFormData.zip_code;
                    formData += '&shipping_address=' + shippingFormData.shipping_address;
                    formData += '&billing_address=' + shippingFormData.billing_address;
                    formData += '&payment_method=' + shippingFormData.payment_method;
                    formData += '&total_price=' + shippingFormData.amount;
                    formData += '&cart=' + JSON.stringify(cart);
                    // console.log(user_email); 
                    // SendEmail(first_name,email,cart,amount);
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/place-order',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            console.log('Form submitted successfully.');
                            console.log(response);
                            if (response.success) {
                                localStorage.removeItem('cart');
                                console.log(amount);
                                SendEmail(first_name,email,cart,amount);
                            window.location.href = '/shop';
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "10000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.success('Order placed successfully');
                            } else {
                                console.log('Order placement failed.');
                            }
                        },
                        
                        error: function(response) {
                            // console.error('Error submitting form:', error);
                        }
                    });
                }
            });
        });
    });

    function SendEmail(first_name,email,cart,amount) {
        console.log(email);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/send-email',
            type: 'POST',
            data: {
                first_name: first_name,
                email: email,
                cart:cart,
                amount:amount,
            },
            success: function(response) {
                console.log(response.message); 
                $('#responseMessage').html(response.message);
            },
            complete: function() {
                $('#loader').hide(); 
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var error in errors) {
                    errorMessage += errors[error][0] + '<br>';
                }
                console.log(errorMessage);
                $('#responseMessage').html(errorMessage);
            }
        });
    }
</script>
