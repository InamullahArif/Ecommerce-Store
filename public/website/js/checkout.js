
    function getCartItems() {
        // console.log('AAAAAAA');
        const cartItemsJSON = localStorage.getItem('cart');
        return cartItemsJSON ? JSON.parse(cartItemsJSON) : [];
    }
    function calculateTotals(items) {
        // console.log(items);
        const subtotal = items.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const shipping = 10;
        var priceString = $("#discount-value").text();
        var discount = parseFloat(priceString.replace(/[$,]/g, ''));
        console.log(priceString,subtotal,shipping);
        // const discount = 0; // Example fixed discount
        const total = subtotal + shipping - discount;
        // console.log(subtotal,shipping,discount); return;
        return { subtotal, shipping, discount, total };
    }
    function displayTotals(totals) {
        // console.log(totals);
        $('#subtotal-value').text(`$${totals.subtotal.toFixed(2)}`);
        $('#shipping-value').text(`$${totals.shipping.toFixed(2)}`);
        $('#discount-value').text(`$${totals.discount.toFixed(2)}`);
        $('#total-value').text(`$${totals.total.toFixed(2)}`);
        $('#payButton').text(`Pay Now $${totals.total.toFixed(2)}`);
    }
    
    // Function to display cart items
    function displayCartItems(items) {
        // console.log(items);
        if (items.length === 0) {
            // console.log('empty');
            $("#place_order").attr('disabled', true); // Set the disabled attribute
            $("#place_order").on('click', function(event) {
                event.preventDefault(); // Prevent default action (navigation)
            });
        } else {
            $("#place_order").removeAttr('disabled'); // Remove the disabled attribute
            $("#place_order").off('click'); // Remove the click event handler
        }
        // const minicartItemsContainer = document.getElementById('minicart-items');
        // minicartItemsContainer.innerHTML = '';
        const minicartItemsContainer = $('#minicart-items');
        minicartItemsContainer.html('');
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
            minicartItemsContainer.append(itemHTML);
        });
    }

    // Fetch and display items on page load
    document.addEventListener('DOMContentLoaded', () => {
        const cartItems = getCartItems();
        displayCartItems(cartItems);
        const totals = calculateTotals(cartItems);
        displayTotals(totals);
    });



    const cities = [
        { country: 'Pakistan', cities: ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Peshawar', 'Quetta', 'Faisalabad', 'Multan', 'Sialkot', 'Gujranwala'] },
        { country: 'Canada', cities: ['Toronto', 'Vancouver', 'Montreal', 'Calgary', 'Edmonton', 'Ottawa', 'Quebec City', 'Winnipeg', 'Hamilton', 'Victoria'] },
        { country: 'United States of America', cities: ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'] },
        { country: 'Australia', cities: ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast', 'Canberra', 'Newcastle', 'Wollongong', 'Hobart'] },
        { country: 'Mexico', cities: ['Mexico City', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'León', 'Ciudad Juárez', 'Zapopan', 'Monterrey', 'Mérida'] },
    ];
    const citySelect = document.getElementById('city-select');

    // Populate cities based on selected country
    function updateCities(selectedCountry) {
    
        // Clear existing options
        citySelect.innerHTML = '';

        // Find matching cities for the selected country
        const matchingCities = cities.find(cityGroup => cityGroup.country === selectedCountry);

        if (matchingCities) {
            // Add cities to the select
            matchingCities.cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }
    }

    // Initialize city dropdown with all cities
    document.addEventListener('DOMContentLoaded', () => {
        const countrySelect = document.getElementById('countrySelect');
        const citySelect = document.getElementById('city-select');

        // Populate citySelect with all cities initially
        cities.forEach(cityGroup => {
            cityGroup.cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        });

        // Listen for changes on the country select
        countrySelect.addEventListener('change', () => {
            updateCities(countrySelect.value);
        });

        // Trigger the change event to populate initial cities
        countrySelect.dispatchEvent(new Event('change'));
    });
    // document.addEventListener('DOMContentLoaded', () => {
    //     // Check if all required fields are filled
    //     function validateForm() {
    //         let isValid = true;
    
    //         // List of required fields
    //         const requiredFields = ['first_name', 'second_name', 'email', 'phone_no', 'zip_code', 'shipping_address', 'billing_address'];
    
    //         requiredFields.forEach(field => {
    //             const input = document.querySelector(`input[name="${field}"]`);
    //             const errorSpan = document.getElementById(field);
    
    //             if (input && input.value.trim() === '') {
    //                 if (errorSpan) {
    //                     errorSpan.textContent = 'This field is required';
    //                     errorSpan.style.display = 'block';
    //                 }
    //                 isValid = false;
    //             } else if (errorSpan) {
    //                 errorSpan.style.display = 'none';
    //             }
    //         });
    
    //         return isValid;
    //     }
    
    //     // Attach event listener to the "Pay Online" radio button
    //     const payOnlineLink = document.querySelector('#onlinePayment').parentElement.querySelector('a');
    //     payOnlineLink.addEventListener('click', function(event) {
    //         // Prevent the default action of the anchor tag
    //         event.preventDefault();
    
    //         // Validate the form
    //         if (validateForm()) {
    //             // If the form is valid, navigate to the stripe page
    //             window.location.href = '/stripe';
    //         }
    //     });
    // });
    
    document.getElementById('sameAsShipping').addEventListener('change', function() {
        const shippingAddress = document.getElementById('shippingAddress1').value;
        const billingAddressInput = document.getElementById('billingAddress1');

        if (this.checked) {
            billingAddressInput.value = shippingAddress;
            billingAddressInput.setAttribute('readonly', true);
        } else {
            billingAddressInput.value = '';
            billingAddressInput.removeAttribute('readonly');
        }
    });
    $(document).ready(function() {
        function validateForm() {
            let isValid = true;
            const requiredFields = ['first_name', 'second_name', 'email', 'phone_no', 'zip_code', 'shipping_address', 'billing_address'];
    
            requiredFields.forEach(field => {
                const input = $(`input[name="${field}"]`);
                const errorSpan = $(`#${field}`);
    
                if (input.val().trim() === '') {
                    if (errorSpan.length) {
                        errorSpan.text('This field is required');
                        errorSpan.show();
                    }
                    isValid = false;
                } else if (errorSpan.length) {
                    errorSpan.hide();
                }
            });
    
            return isValid;
        }
        
        $('#payOnlineLink').on('click', function(event) {
            event.preventDefault();
    
            if (validateForm()) {
                const formData = {
                    first_name: $('input[name="first_name"]').val(),
                    second_name: $('input[name="second_name"]').val(),
                    email: $('input[name="email"]').val(),
                    phone_no: $('input[name="phone_no"]').val(),
                    country: $('select[name="country"]').val(),
                    city: $('select[name="city"]').val(),
                    zip_code: $('input[name="zip_code"]').val(),
                    shipping_address: $('input[name="shipping_address"]').val(),
                    billing_address: $('input[name="billing_address"]').val(),
                    payment_method: $('input[name="payment_method"]:checked').val(),
                    // amount: $('#total-value').text(),
                    amount: $('#total-value').text().replace(/[^\d.-]/g, ''),
                    discount: $('#discount-value').text().replace(/[^\d.-]/g, ''),
                };
                // console.log(formData); return;
                // Store the formData object in local storage
                localStorage.setItem('shippingFormData', JSON.stringify(formData));
    
                // Navigate to the stripe page
                window.location.href = '/stripe';
            }
        });
    });
    function applyDiscount(discount)
    {
        var priceString = $("#subtotal-value").text();
        var price = parseFloat(priceString.replace(/[$,]/g, ''));
        var discountAmount = (price * discount) / 100;
        var remainingAmount = price - discountAmount;
        remainingAmount = remainingAmount + 10;
        $("#discount-value").text("$" + discountAmount.toFixed(2));
        $("#total-value").text("$" + remainingAmount.toFixed(2));
        $("#hidden_promo").text("$" + remainingAmount.toFixed(2));
    }
    function SendEmail(first_name,email,cart,amount) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // console.log(email,cart); return;
        // var cart = JSON.parse(localStorage.getItem('cart'));
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
    function submitForm() {
        var formData = $('#shippingForm').serialize();
        // var cart = JSON.parse(localStorage.getItem('cart'));
        // Send AJAX request
        var promo_code = null;
        promo_code = $('input[name="promo_code"]').text();
        console.log(promo_code);
        var totalPrice1 = parseFloat(promo_code.replace(/[$,]/g, ''));
        console.log(totalPrice1);
        var cart = JSON.parse(localStorage.getItem('cart'));
        if(promo_code)
        {
            formData += '&total_price=' + totalPrice1;
        }else
        {
            console.log('promo code does not exists',promo_code); 
            var totalPrice = 0;
            if (cart && cart.length > 0) {
                totalPrice = cart.reduce(function(acc, item) {
                    return acc + (item.quantity * item.price);
                }, 0);
            }
            // console.log(totalPrice); return;
            totalPrice = totalPrice + 10;
            formData += '&total_price=' + totalPrice;
        }
        
        var email = $('input[name="email"]').val();
        var first_name = $('input[name="first_name"]').val();
        var amount = $('#total-value').text().replace(/[^\d.-]/g, '');
        // console.log(email,cart); return;
        // console.log(formData); return;
        // for (var pair of formData.entries()) {
        // console.log(pair[0] + ", " + pair[1]);
        // }
        // console.log(formData);
        $('#loader').show();
        SendEmail(first_name,email,cart,amount); 
        formData += '&cart=' + JSON.stringify(cart);
        $.ajax({
            url: '/place-order',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log('Form submitted successfully.');
                console.log(response);
                if (response.success) {
                    localStorage.removeItem('cart');
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
                console.log(response);
                if (response.responseJSON.errors.first_name) {
                    $("#first_name").css("display", "block");
                    $("#first_name").text(
                        response.responseJSON.errors.first_name
                    );
                }else
                {
                    $("#first_name").css("display", "none");
                }
                if (response.responseJSON.errors.second_name) {
                    $("#second_name").css("display", "block");
                    $("#second_name").text(
                        response.responseJSON.errors.second_name
                    );
                }else
                {
                    $("#second_name").css("display", "none");
                }
                if (response.responseJSON.errors.email) {
                    $("#email").css("display", "block");
                    $("#email").text(
                        response.responseJSON.errors.email
                    );
                }else
                {
                    $("#email").css("display", "none");
                }
                if (response.responseJSON.errors.phone_no) {
                    $("#phone_no").css("display", "block");
                    $("#phone_no").text(
                        response.responseJSON.errors.phone_no
                    );
                }else
                {
                    $("#phone_no").css("display", "none");
                }
                if (response.responseJSON.errors.zip_code) {
                    $("#zip_code").css("display", "block");
                    $("#zip_code").text(
                        response.responseJSON.errors.zip_code
                    );
                }else
                {
                    $("#zip_code").css("display", "none");
                }
                if (response.responseJSON.errors.shipping_address) {
                    $("#shipping_address").css("display", "block");
                    $("#shipping_address").text(
                        response.responseJSON.errors.shipping_address
                    );
                }else
                {
                    $("#shipping_address").css("display", "none");
                }
                if (response.responseJSON.errors.billing_address) {
                    $("#billing_address").css("display", "block");
                    $("#billing_address").text(
                        response.responseJSON.errors.billing_address
                    );
                }else
                {
                    $("#billing_address").css("display", "none");
                }
            }
        });
    }
    $("#promoCode").on('click', function(event) {
        event.preventDefault(); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var promo_code = $("#inputPromo").val();
        // console.log(email,cart); return;
        // var cart = JSON.parse(localStorage.getItem('cart'));
        $.ajax({
            url: '/validatePromoCode',
            type: 'POST',
            data: {
                promo_code: promo_code,
            },
            success: function(response) {
                $("#promo_span").css("display", "none");
                // console.log(response.promoCode.discount_percentage);
                if(response.success == true)
                {
                    applyDiscount(response.promoCode.discount_percentage);
                }
                // $('#responseMessage').html(response.message);
            },
            //  complete: function() {
            //     $('#loader').hide(); 
            // },
            error: function(xhr) {
                var errors = xhr.responseJSON.error;
                // console.log(errors);
                // $('#promo_span').text(errors);
                if (errors) {
                    $("#promo_span").css("display", "block");
                    $("#promo_span").text(
                        errors
                    );
                }else
                {
                    $("#promo_span").css("display", "none");
                }
                $("#discount-value").text("$0.00");
               var subtotal = $("#subtotal-value").text();
               console.log(subtotal);
                subtotal = parseFloat(subtotal.replace(/[$,]/g, ''));
                subtotal = subtotal + 10;
                // console.log(subtotal);
                $("#total-value").text("$" + subtotal.toFixed(2));
            }
        });
    });