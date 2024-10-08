document.addEventListener('DOMContentLoaded', function () {
    const colorOptions = document.querySelectorAll('#color-options input[type="radio"]');
    
    colorOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Remove the selected class from all labels
            document.querySelectorAll('.variant-label').forEach(label => {
                label.classList.remove('selected');
            });
            
            // Add the selected class to the label of the selected radio button
            const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
            selectedLabel.classList.add('selected');
        });
        
        // Initialize the selected class on page load for the checked radio button
        if (option.checked) {
            const selectedLabel = document.querySelector(`label[for="${option.id}"]`);
            selectedLabel.classList.add('selected');
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const sizeOptions = document.querySelectorAll('#size-options input[type="radio"]');
    
    sizeOptions.forEach(option => {
        option.addEventListener('change', function () {
            // Remove the selected class from all labels
            document.querySelectorAll('.variant-label').forEach(label => {
                label.classList.remove('selected');
            });
            
            // Add the selected class to the label of the selected radio button
            const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
            selectedLabel.classList.add('selected');
        });
        
        // Initialize the selected class on page load for the checked radio button
        if (option.checked) {
            const selectedLabel = document.querySelector(`label[for="${option.id}"]`);
            selectedLabel.classList.add('selected');
        }
    });
    
    // Add click event listeners to labels to select the corresponding radio button
    document.querySelectorAll('.variant-label').forEach(label => {
        label.addEventListener('click', function () {
            const radioId = this.getAttribute('for');
            const radioInput = document.getElementById(radioId);
            
            if (radioInput) {
                radioInput.checked = true;
                // Remove selected class from all labels
                document.querySelectorAll('.variant-label').forEach(label => {
                    label.classList.remove('selected');
                });
                // Add selected class to clicked label
                this.classList.add('selected');
            }
        });
    });
});

$(document).ready(function() {
    // console.log('here');
    // $('#size-options input[type=radio]').change(function() {
    //     console.log('here1');
    //     var sizeId = $(this).val();
    //     console.log(sizeId);

    //     $.getJSON('/get-size-details', { sizeId: sizeId }, function(data) {
    //         console.log(data);
    //         $('.selected-size-quantity').text('Quantity: ' + data.quantity);
    //     }).fail(function(jqXHR, textStatus, errorThrown) {
    //         console.error('Error fetching size details:', textStatus, errorThrown);
    //     });
    // });
    // function fetchFilteredProducts(selectedCategories) {
    //     $.ajax({
    //         url: '/shop', // Make sure this matches your Laravel route
    //         type: 'GET',
    //         data: {
    //             categories: selectedCategories
    //         },
    //         success: function(response) {
    //             $('.collection-product-container').empty(); // Clear existing products
    //             var products = response.products; // Assuming response structure
    //             console.log(response);
    //             // Append each product card
    //             products.forEach(function(product) {
    //                 image = product.images[0].name;
    //                 console.log(image);
    //                 var productUrl = "/product/:slug";
    //                 productUrl = productUrl.replace(':slug', product.slug);
    //                 console.log(productUrl);
    //                 var productHtml = `
    //                         <div class="col-lg-4 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
    //                             <div class="product-card">
    //                                 <div class="product-card-img">
    //                                     <a class="hover-switch" href="${productUrl}">
    //                                         <img class="primary-img" src="${image}" alt="product-img">
    //                                     </a>
    //                                     <div class="product-card-action product-card-action-2 justify-content-center">
    //                                         <a href="#quickview-modal" class="action-card action-quickview" data-bs-toggle="modal">
    //                                             <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                                                 <path d="M10 0C15.5117 0 20 4.48828 20 10C20 12.3945 19.1602 14.5898 17.75 16.3125L25.7188 24.2812L24.2812 25.7188L16.3125 17.75C14.5898 19.1602 12.3945 20 10 20C4.48828 20 0 15.5117 0 10C0 4.48828 4.48828 0 10 0ZM10 2C5.57031 2 2 5.57031 2 10C2 14.4297 5.57031 18 10 18C14.4297 18 18 14.4297 18 10C18 5.57031 14.4297 2 10 2ZM11 6V9H14V11H11V14H9V11H6V9H9V6H11Z" fill="#00234D" />
    //                                             </svg>
    //                                         </a>
    //                                         <a href="#" class="action-card action-wishlist">
    //                                             <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                                                 <path d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z" fill="#00234D" />
    //                                             </svg>
    //                                         </a>
    //                                         <a href="#" class="action-card action-addtocart">
    //                                             <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                                                 <path d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z" fill="#00234D" />
    //                                             </svg>
    //                                         </a>
    //                                     </div>
    //                                 </div>
    //                                 <div class="product-card-details">
    //                                     <h3 class="product-card-title">
    //                                         <a href="${product.slug}">${product.name}</a>
    //                                     </h3>
    //                                     <div class="product-card-price">
    //                                         <span class="card-price-regular">$${product.price}</span>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                 `;
    //                 $('.collection-product-container').append(productHtml);
    //             });
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error fetching products:', error);
    //         }
    //     });
    // }
    

    // When a category checkbox is changed
    // $('.category-checkbox').change(function() {
    //     var selectedCategories = [];
    //     // console.log('here');
    //     // Collect all checked category IDs
    //     $('.category-checkbox:checked').each(function() {
    //         selectedCategories.push($(this).val());
    //     });
    //     console.log(selectedCategories);
    //     // Fetch filtered products
    //     fetchFilteredProducts(selectedCategories);
    // });
});
