
function previewImage(event) {
    var files = event.target.files;
    var container = document.getElementById('imagePreviews');

    // Clear existing previews
    container.innerHTML = '';
    console.log(files,files.length);
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.onload = function(e) {
            // console.log(e.target.result);
            var img = document.createElement('img');
            img.src = e.target.result;
            // console.log(img);
            img.style.width = "110px"; // Set desired width
            img.style.height = "auto";
            container.appendChild(img); // Append the image to the container
        };

        reader.readAsDataURL(file);
    }
}
// let repeaterIndex = 0;
// function addRepeaterItem() {
//     const repeaterContainer = document.getElementById('form-repeater-container');
//     const newRepeater = document.querySelector('.form-repeater').cloneNode(true);

//     // Clear input values and update the name attributes for the new repeater item
//     newRepeater.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
//         const name = checkbox.getAttribute('name');
//         const newName = name.replace(/\[\d+\]/, '[' + repeaterIndex + ']');
//         checkbox.setAttribute('name', newName);
//         checkbox.checked = false; // Uncheck checkboxes
//     });

//     // Clear product quantity input value
//     newRepeater.querySelectorAll('input[name^="products["][name$="[quantity][]"]').forEach((quantityInput, index) => {
//         quantityInput.value = ''; // Clear each quantity input value
//         const newName = quantityInput.getAttribute('name').replace(/\[\d+\]/, '[' + repeaterIndex + ']');
//         quantityInput.setAttribute('name', newName); // Update name attribute
//     });

//     // Show the remove button for the new repeater item
//     newRepeater.querySelector('.remove-form-repeater').style.display = 'block';

//     // Append the new repeater item to the container
//     repeaterContainer.appendChild(newRepeater);

//     repeaterIndex++;
// }
// function removeRepeaterItem(button) {
//     const repeaterItem = button.closest('.form-repeater');
//     repeaterItem.remove();
// }
let repeaterIndex = document.querySelectorAll('.form-repeater').length; // Start with the current number of form repeaters

function addRepeaterItem() {
    const repeaterContainer = document.getElementById('form-repeater-container');
    const template = document.querySelector('.form-repeater').cloneNode(true);

    // Clear input values and update the name attributes for the new repeater item
    template.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        const name = checkbox.getAttribute('name');
        const newName = name.replace(/\[\d+\]/, '[' + repeaterIndex + ']');
        checkbox.setAttribute('name', newName);
        checkbox.checked = false; // Uncheck checkboxes
    });

    // Clear product quantity input value
    template.querySelectorAll('input[name^="products["][name$="[quantity][]"]').forEach((quantityInput) => {
        const newName = quantityInput.getAttribute('name').replace(/\[\d+\]/, '[' + repeaterIndex + ']');
        quantityInput.setAttribute('name', newName); // Update name attribute
        quantityInput.value = ''; // Clear each quantity input value
    });

    // Show the remove button for the new repeater item
    template.querySelector('.remove-form-repeater').style.display = 'block';

    // Append the new repeater item to the container
    repeaterContainer.appendChild(template);

    repeaterIndex++;
}

function removeRepeaterItem(button) {
    const repeaterItem = button.closest('.form-repeater');
    repeaterItem.remove();

    // Update indexes of remaining items to maintain consistency
    const remainingItems = document.querySelectorAll('.form-repeater');
    remainingItems.forEach((item, index) => {
        item.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            const name = checkbox.getAttribute('name');
            const newName = name.replace(/\[\d+\]/, '[' + index + ']');
            checkbox.setAttribute('name', newName);
        });
        
        item.querySelectorAll('input[name^="products["][name$="[quantity][]"]').forEach((quantityInput) => {
            const name = quantityInput.getAttribute('name');
            const newName = name.replace(/\[\d+\]/, '[' + index + ']');
            quantityInput.setAttribute('name', newName);
        });
    });

    repeaterIndex = remainingItems.length;
}
function openDeleteModalProduct(slug) {
    console.log(slug);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log('product');
    Swal.fire({
        text: 'Are you sure you want to delete this product?',
        showClass: {
            popup: "animate__animated animate__backInDown",
        },
        showCancelButton: true,
        confirmButtonText: "Yes",
        confirmButtonColor: '#3085d6',
        customClass: {
            confirmButton: 'swal-button-size',
            cancelButton: 'swal-button-size',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'products/' + slug + '/destroy',
                type: "GET",
                data: {},
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        $('#row-' + response.product.id).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your product has been deleted.',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'swal-button-size'
                            },
                            willClose: () => {

                            }
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Failed to delete product.',
                            'error'
                        );
                    }
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
                    toastr.success('Product deleted successfully');
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Failed to delete product.',
                        'error'
                    );
                }
            });
        }
    });
}


$(document).ready(function() {
    $('.del_product').on('click', function(event) {
        event.preventDefault();
        console.log('here');
        var slug = $(this).data('product-id');
        console.log(slug);
        openDeleteModalProduct(slug);
    });
    // $('.color-checkbox').click(function() {
    //     // Uncheck all other checkboxes
    //     $('.color-checkbox').not(this).prop('checked', false);
    // });
    // $('.size-checkbox').click(function() {
    //     // Uncheck all other checkboxes
    //     $('.size-checkbox').not(this).prop('checked', false);
    // });
});

function searchResource() {
    var search = document.getElementById("source_search");
    var search_by_name = document.getElementById("source_search").value;
    table = search.getAttribute("data-table");
    var url = window.location.href.split('?')[0];
    console.log(url);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // console.log('url:',url,'search_by_name"',search_by_name,'table:',table);
    $.ajax({
        url: url,
        type: "get",
        dataType: "JSON",
        data: {
            search_by_name: search_by_name,
            // department_id: department_id,
        },
        success: function(response) {
            console.log(response.data);
            // $("#" + table + " tbody tr").remove();
            // $("#" + table + " tbody").append(response.data);
            // $(".paginationLinks").html(response.pagination);
            $("#" + table).empty();
            // Append the new data
            $("#" + table).append(response.data);
        },
        error: function(response) {
            // debugger;
        },
    });
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('productTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_product')) {
            event.preventDefault();
            const productId = event.target.closest('.del_product').dataset.productId;
            // console.log(logId); return
            openDeleteModalProduct(productId);
        }
    });
});