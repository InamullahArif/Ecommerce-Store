$(document).ready(function() {
   
    loadCartPage();
});
function loadCartPage() {
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
                        <button class="qty-btn dec-qty" data-index="${index}"><img src="website/img/icon/minus.svg" alt="minus"></button>
                        <input class="qty-input" type="number" name="qty" value="${item.quantity}" min="0">
                        <button class="qty-btn inc-qty" data-index="${index}"><img src="website/img/icon/plus.svg" alt="plus"></button>
                    </div>
                    <a href="#" class="product-remove mt-2" data-index="${index}">Remove</a>                           
                </td>
                <td class="cart-item-price text-end">
                <div class="product-price">$${item.price.toFixed(2)}</div>                           
                </td>                        
            </tr>
        `;
        $cartItems.append(cartItemHTML);
    });

    var total = subtotal + shipping - discount;

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