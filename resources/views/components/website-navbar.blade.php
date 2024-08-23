<!-- header start -->
<header class="sticky-header border-btm-black header-1">
    <div class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-4">
                    <div class="header-logo">
                        <a href="/" class="logo-main">
                            <img src="{{ asset($image->name ?? 'website/img/logo.png') }}" loading="lazy" alt="bisum"
                                style="width:45%;height:45%;">

                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none">
                    <nav class="site-navigation">
                        <ul class="main-menu list-unstyled justify-content-center">
                            @if (isset($data))
                                {{-- {{dd($data)}} --}}
                                @foreach ($data as $d)
                                    @if (empty($d->subfields))
                                        <li class="menu-list-item nav-item has-dropdown active">
                                            <div class="mega-menu-header">
                                                <a class="nav-link" href="{{ '/' . $d->link }}">
                                                    {{ $d->name }}
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        <li class="menu-list-item nav-item has-dropdown active">
                                            <div class="mega-menu-header">
                                                <a class="nav-link">{{ $d->name }}</a>
                                                <span class="open-submenu">
                                                    <svg class="icon icon-dropdown" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </span>
                                            </div>
                                            @foreach ($d->subfields as $sub)
                                                <div class="submenu-transform submenu-transform-desktop">
                                                    <ul class="submenu list-unstyled">
                                                        <li class="menu-list-item nav-item-sub">
                                                            <a class="nav-link-sub nav-text-sub"
                                                                href="{{ '/' . $sub->sub_link }}">{{ $sub->sub_name }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-8 col-8">
                    <div class="header-action d-flex align-items-center justify-content-end">
                        <a class="header-action-item header-search" href="javascript:void(0)">
                            <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-wishlist ms-4 d-none d-lg-block" href="/wishlist">
                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-cart ms-4" href="#drawer-cart" data-bs-toggle="offcanvas">
                            <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-hamburger ms-4 d-lg-none" href="#drawer-menu"
                            data-bs-toggle="offcanvas">
                            <svg class="icon icon-hamburger" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-wrapper">
            <div class="container">
                <form class="search-form d-flex align-items-center">
                    <button type="submit" class="search-submit bg-transparent pl-0 text-start">
                        <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                fill="black" />
                        </svg>
                    </button>
                    <div class="search-input mr-4">
                        <input type="text" name="query" id="query" placeholder="Search your products..."
                            autocomplete="off">
                    </div>
                    <div class="search-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
                <!-- Place the search results container here -->
                <div id="search-results" class="search-results">
                </div>

            </div>
        </div>

    </div>
</header>
<style>
    .search-results ul {
        list-style-type: none;
        /* Remove default bullets */
        padding: 0;
        margin: 0;
    }

    .search-results li {
        padding: 8px 12px;
        border-bottom: 1px solid #ddd;
    }

    .search-results li:last-child {
        border-bottom: none;
    }

    .result-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .result-icon {
        margin-right: 10px;
        /* Space between icon and text */
    }

    .result-text {
        flex-grow: 1;
        /* Allow text to take up remaining space */
        font-size: 14px;
        font-family: Arial, sans-serif;
    }

    .model-name {
        font-size: 12px;
        color: #666;
        white-space: nowrap;
        /* Prevent text from wrapping */
    }

    .search-results li:hover {
        background-color: #f0f0f0;
        /* Slight grey background on hover */
    }

    .results-container {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        width: 200px;
        cursor: pointer;
    }

    .card-img {
        width: 100%;
        height: auto;
    }

    .card-body {
        padding: 8px;
    }

    .card-text {
        font-size: 16px;
        font-family: Arial, sans-serif;
        margin: 0;
    }

    .model-name {
        font-size: 12px;
        color: #666;
        margin-top: 4px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#query').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '{{ route('search') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        var resultsContainer = $('#search-results');
                        resultsContainer.empty();

                        if (data) {
                            var resultsList = $('<ul></ul>');
                            for (var model in data) {
                                if (data.hasOwnProperty(model)) {
                                    var items = data[model];
                                    items.forEach(function(item) {
                                        var displayText = '';
                                        var result = item.result;
                                        console.log(result);

                                        var icon =
                                            '<svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.743a6 6 0 1 0-1.757 1.757 6.013 6.013 0 0 0 1.757-1.757zM6 1a5 5 0 1 1 0 10A5 5 0 0 1 6 1z"/></svg>';
                                        if (result) {
                                            for (var key in result) {
                                                // console.log(key);
                                                if (result.hasOwnProperty(key) &&
                                                    result[key] &&
                                                    typeof result[key] === 'string'
                                                    ) {
                                                    displayText = result[key];
                                                    break;
                                                }
                                            // console.log(displayText); return;
                                            }
                                        }

                                        var resultItem = $('<li></li>')
                                            .html('<div class="result-content">' +
                                                '<span class="result-icon">' +
                                                icon + '</span>' +
                                                '<span class="result-text">' +
                                                displayText + '</span>' +
                                                '<span class="model-name">' +
                                                model + '</span>' +
                                                '</div>')
                                            .data('id', result.id)
                                            .data('model', model);

                                        resultsList.append(resultItem);
                                    });
                                }
                            }

                            resultsContainer.append(resultsList);
                        } else {
                            resultsContainer.append('<p>No results found.</p>');
                        }
                    },
                    error: function(xhr) {
                        console.error('An error occurred', xhr.responseText);
                    }
                });
            } else {
                $('#search-results').empty();
            }
        });


        $(document).on('click', '#search-results li', function() {
            var id = $(this).data('id');
            var model = $(this).data('model');
            $.ajax({
                url: '/goToSearch',
                type: 'POST',
                data: {
                    id: id,
                    model: model,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // if (response.product) {
                    //     var slug = response.product.slug;
                    //     var url = `/product/${slug}`;
                    //     window.location.href = url;
                    // } else if (response.blog) {
                    //     var slug = response.blog.slug;
                    //     var url = `/blogs/${slug}`;
                    //     window.location.href = url;
                    // }
                    // console.log(model,response.data.slug); return;
                    model = model.toLowerCase() + 's';
                    if (response.data.slug) {
                        var url = `/${model}/${response.data.slug}/show`;
                        window.location.href = url;
                    } else {
                        var url = `/${model}/${response.data.id}/show`;
                        window.location.href = url;
                    }

                },
                error: function(xhr) {
                    console.error('An error occurred', xhr.responseText);
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        function loadCartItems() {
            var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
            var $cartItemsContainer = $('#cart-items-container');
            var $cartSubtotal = $('.cart-subprice');
            var $cartEmptyArea = $('.cart-empty-area');
            var $cartContentArea = $('.cart-content-area');

            $cartItemsContainer.empty(); // Clear existing items

            if (cart.length > 0) {
                var totalItems = 0;
                var totalPrice = 0;

                cart.forEach(function(item, index) {
                    var $cartItem = $('<div class="minicart-item d-flex">\
                                        <div class="mini-img-wrapper">\
                                            <img class="mini-img" src="' + item.image + '" alt="img">\
                                        </div>\
                                        <div class="product-info">\
                                            <h2 class="product-title"><a href="#">' + item.name + '</a></h2>\
                                            <p class="product-vendor">' + item.size + ' / ' + item.color + '</p>\
                                            <div class="misc d-flex align-items-end justify-content-between">\
                                                <div class="quantity d-flex align-items-center justify-content-between">\
                                                    <button class="qty-btn dec-qty" data-index="' + index + '"><img src="{{ asset('website/img/icon/minus.svg') }}" alt="minus"></button>\
                                                    <input class="qty-input" type="number" name="qty" value="' + item
                        .quantity + '" min="0">\
                                                    <button class="qty-btn inc-qty" data-index="' + index + '"><img src="{{ asset('website/img/icon/plus.svg') }}" alt="plus"></button>\
                                                </div>\
                                                <div class="product-remove-area d-flex flex-column align-items-end">\
                                                    <div class="product-price">$' + item.price + '</div>\
                                                    <a href="#" class="product-remove" data-index="' + index + '">Remove</a>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>');

                    $cartItemsContainer.append($cartItem);

                    totalItems += parseInt(item.quantity);
                    totalPrice += parseFloat(item.price) * parseInt(item.quantity);
                });

                // Update subtotal and show cart content
                $cartSubtotal.text('$' + totalPrice.toFixed(2));
                $cartEmptyArea.addClass('d-none');
                $cartContentArea.removeClass('d-none');
            } else {
                // If cart is empty, show empty cart message
                $cartEmptyArea.removeClass('d-none');
                $cartContentArea.addClass('d-none');
            }
        }

        // Initial load of cart items when page is ready
        loadCartItems();

        // Click event handler for opening cart drawer
        $('.header-cart').on('click', function(e) {
            e.preventDefault();

            // Load cart items and then open the cart drawer
            loadCartItems();
            $('#drawer-cart').offcanvas('show');
        });

        // Click event handler for removing item from cart
        $('#cart-items-container').on('click', '.product-remove', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var cart = JSON.parse(localStorage.getItem('cart'));

            // Remove item from cart array
            cart.splice(index, 1);

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Reload cart items after removal
            loadCartItems();
            const cartItems = getCartItems();
            displayCartItems(cartItems);
            const totals = calculateTotals(cartItems);
            displayTotals(totals);
            loadCartPage();
        });

        // Click event handler for decreasing quantity
        $('#cart-items-container').on('click', '.dec-qty', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var cart = JSON.parse(localStorage.getItem('cart'));

            // Decrease quantity if greater than 1
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            }

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Reload cart items after quantity update
            loadCartItems();

            // getCartItems();
            // console.log('dd');
            const cartItems = getCartItems();
            displayCartItems(cartItems);
            const totals = calculateTotals(cartItems);
            displayTotals(totals);
            loadCartPage();
            // console.log('here');
        });

        // Click event handler for increasing quantity
        $('#cart-items-container').on('click', '.inc-qty', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var cart = JSON.parse(localStorage.getItem('cart'));

            // Increase quantity
            cart[index].quantity++;

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Reload cart items after quantity update
            loadCartItems();
            const cartItems = getCartItems();
            displayCartItems(cartItems);
            const totals = calculateTotals(cartItems);
            displayTotals(totals);
            loadCartPage();
        });

        // Optionally, handle form submission for updating quantities

        // Example: Update quantity on input change
        $('#cart-items-container').on('change', '.qty-input', function() {
            var index = $(this).closest('.minicart-item').index();
            var newQuantity = parseInt($(this).val());

            if (!isNaN(newQuantity) && newQuantity >= 0) {
                var cart = JSON.parse(localStorage.getItem('cart'));
                cart[index].quantity = newQuantity;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCartItems();
            }
        });
    });
</script>
