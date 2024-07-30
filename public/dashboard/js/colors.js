$(document).ready(function () {
    
});
$('.del_colors').on('click', function (event) {
    event.preventDefault();
    // console.log('here');
    var colorId = $(this).data('color-id');
    // console.log(categoryId);
    openDeleteModalColor(colorId);
});
function openDeleteModalColor(colorId) {
    // console.log(categoryId);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // console.log('category');
    Swal.fire({
        text: 'Are you sure you want to delete this color?',
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
                url: '/colors/' + colorId + "/destroy",
                type: "GET",
                data: {},
                success: function (response) {
                    if (response.success) {
                        $('#row-' + response.color.slug).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Color has been deleted.',
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
                            'Failed to delete color.',
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
                    toastr.success('Color deleted successfully');
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to delete color.',
                        'error'
                    );
                }
            });
        }
    });
}

function showColorModal() {
    $("#color_name").val('');
    $("#color_id").val('');
    // $("#color_description").val('');
    $("#name_error").val('');
    // $("#description_error").val('');
    $("#exampleModalCenterTitle").text("Add color");
    $("#color-modal").modal('show');

}

function closeColorModal() {
    $("#color-modal").modal('hide');

}

function openEditColorModal(slug) {
    console.log(slug);
    $.ajax({
        url: "/colors/" + slug,
        type: "get",
        success: function (response) {
            console.log(response.color.name);
            $("#color_name").val(response.color.name);
            // $("#category_description").val(response.category.description);
            // $("#exampleModalCenterTitle").text("");
            $("#name_error").text('');
            // $("#description_error").text('');
            $("#exampleModalCenterTitle").text("Edit Color");
            $("#color_id").val(response.color.slug);
            $("#color_no").val();
            $("#color-modal").modal('show');
        },
        error: function (xhr, status, error) {
            // Handle error response
        }
    });
    // $("#category-modal").modal('hide');

}

function saveColor() {
    var colorId = $("#color_id").val();
    // console.log(colorId);
    var colorName = $("#color_name").val();
    // var colorDescription = $("#color_description").val();
    let formData = $("#color_form").serialize();
    // console.log(formData);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log(colorId);
    if (colorId) {
        $.ajax({
            url: "/colors/" + colorId + "/update",
            type: "POST",
            data: {
                name: colorName,
                // description: categoryDescription,
            },
            success: function (response) {
                console.log(response.category);
                if (response.success) {
                    $('#row-' + colorId).remove(); // Define the maximum length for description
                    let updatedColorHtml = `
                    <li class="roles-item" id="row-${response.color.slug}">
                        <div class="body-text">${response.color.name || '--'}</div>
                        <div class="list-icon-function">
                            <div class="item edit">
                                <a onclick="openEditColorModal('${response.color.slug}')" data-color-id="${response.color.slug}">
                                    <i class="icon-edit-3"></i>
                                </a>
                            </div>
                            <div class="item trash">
                                <a href="#" class="delete-user del_colors" data-color-id="${response.color.slug}">
                                    <i class="icon-trash-2"></i>
                                </a>
                            </div>
                        </div>
                    </li>`;
                
                    $('#colorTable').append(updatedColorHtml);
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Color has been updated.',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'swal-button-size'
                        },
                        willClose: () => {}
                    });

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
                    toastr.success('Color updated successfully');
                    $("#color-modal").modal('hide');
                }

            },
            error: function (xhr, status, error) {
                // Handle error response
                // You can show an error message to the user
                var errors = xhr.responseJSON.errors;
                if (errors.name) {
                    $('#name_error').text(errors.name[0]).show();
                }
            }
        });
    } else {
        $.ajax({
            url: "/colors/store",
            type: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                let colorHtml = `
                <li class="roles-item" id="row-${response.color.slug}">
                    <div class="body-text">${response.color.name || '--'}</div>
                    <div class="list-icon-function">
                        <div class="item edit">
                            <a onclick="openEditColorModal('${response.color.slug}')" data-color-id="${response.color.slug}">
                                <i class="icon-edit-3"></i>
                            </a>
                        </div>
                        <div class="item trash">
                            <a href="#" class="delete-user del_colors" data-color-id="${response.color.slug}">
                                <i class="icon-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </li>`;

                // Append the new list item to the list
                $('#colorTable').append(colorHtml);

                // Close the modal
                closeColorModal();

                // Show success notification
                Swal.fire({
                    title: 'Added!',
                    text: 'Color has been added.',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'swal-button-size'
                    },
                    willClose: () => {
                        // Do something when modal is closed
                    }
                });

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
                toastr.success('Color added successfully');
            },
            error: function (xhr, status, error) {
                // Handle error response
                // console.log(error);
                var errors = xhr.responseJSON.errors;
                // console.log(errors);
                if (errors.name) {
                    $('#name_error').text(errors.name[0]).show();
                }
            }
        });
    }

    // console.log('Category Name:', categoryName);

}

function closeColorModal() {
    $('#color-modal').modal('hide');
}

function searchResource() {
    var search = document.getElementById("source_search");
    var search_by_name = document.getElementById("source_search").value;
    table = search.getAttribute("data-table");
    var url = window.location.href.split('?')[0];
    // console.log(url);
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
        success: function (response) {
            console.log(response.data);
            $("#" + table).empty();
            $("#" + table).append(response.data);
        },
        error: function (response) {
            // debugger;
        },
    });
}
document.addEventListener('DOMContentLoaded', function() {
    // Event delegation for delete buttons
    document.getElementById('colorTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_colors')) {
            event.preventDefault();
            const colorId = event.target.closest('.del_colors').dataset.colorId;
            deleteColor(colorId);
        }
    });
});
    function deleteColor(colorId) {
        // Your delete logic here
        // console.log(`Delete category with ID: ${categoryId}`);
        openDeleteModalColor(colorId);
        // For example, make an AJAX call to delete the category
    }
