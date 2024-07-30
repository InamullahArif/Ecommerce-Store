$(document).ready(function () {
    
});
$('.del_sizes').on('click', function (event) {
    event.preventDefault();
    var sizeId = $(this).data('size-id');
    openDeleteModalSize(sizeId);
});
function openDeleteModalSize(sizeId) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    Swal.fire({
        text: 'Are you sure you want to delete this Size?',
        showClass: {
            popup: "animate__animated animate__backInDown",
        },
        showCancelButton: true,
        confirmButtonText: "Yes",
        confirmButtonsize: '#3085d6',
        customClass: {
            confirmButton: 'swal-button-size',
            cancelButton: 'swal-button-size',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/sizes/' + sizeId + "/destroy",
                type: "GET",
                data: {},
                success: function (response) {
                    if (response.success) {
                        $('#row-' + response.size.slug).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Size has been deleted.',
                            icon: 'success',
                            confirmButtonsize: '#3085d6',
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
                            'Failed to delete size.',
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
                    toastr.success('Size deleted successfully');
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to delete size.',
                        'error'
                    );
                }
            });
        }
    });
}

function showSizeModal() {
    $("#size_name").val('');
    $("#size_id").val('');
    $("#name_error").val('');
    $("#exampleModalCenterTitle").text("Add size");
    $("#size-modal").modal('show');

}

function closeSizeModal() {
    $("#size-modal").modal('hide');

}

function openEditSizeModal(slug) {
    console.log(slug);
    $.ajax({
        url: "/sizes/" + slug,
        type: "get",
        success: function (response) {
            console.log(response);
            $("#size_name").val(response.size.name);
            // $("#category_description").val(response.category.description);
            // $("#exampleModalCenterTitle").text("");
            $("#name_error").text('');
            // $("#description_error").text('');
            $("#exampleModalCenterTitle").text("Edit size");
            $("#size_id").val(response.size.slug);
            $("#size_no").val();
            $("#size-modal").modal('show');
        },
        error: function (xhr, status, error) {
            // Handle error response
        }
    });
    // $("#category-modal").modal('hide');

}

function saveSize() {
    var sizeId = $("#size_id").val();
    // console.log(sizeId);
    var sizeName = $("#size_name").val();
    // var sizeDescription = $("#size_description").val();
    let formData = $("#size_form").serialize();
    // console.log(formData);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log(sizeId);
    if (sizeId) {
        $.ajax({
            url: "/sizes/" + sizeId + "/update",
            type: "POST",
            data: {
                name: sizeName,
                // description: categoryDescription,
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#row-' + sizeId).remove(); // Define the maximum length for description
                    let updatedSizeHtml = `
                    <li class="roles-item" id="row-${response.size.slug}">
                        <div class="body-text">${response.size.name || '--'}</div>
                        <div class="list-icon-function">
                            <div class="item edit">
                                <a onclick="openEditSizeModal('${response.size.slug}')" data-size-id="${response.size.slug}">
                                    <i class="icon-edit-3"></i>
                                </a>
                            </div>
                            <div class="item trash">
                                <a href="#" class="delete-user del_sizes" data-size-id="${response.size.slug}">
                                    <i class="icon-trash-2"></i>
                                </a>
                            </div>
                        </div>
                    </li>`;
                
                    $('#sizeTable').append(updatedSizeHtml);
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Size has been updated.',
                        icon: 'success',
                        confirmButtonsize: '#3085d6',
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
                    toastr.success('Size updated successfully');
                    $("#size-modal").modal('hide');
                }

            },

            error: function (xhr, status, error) {
                // Handle error response
                // You can show an error message to the user
                // console.log(errors);
                var errors = xhr.responseJSON.errors;
                if (errors.name) {
                    $('#name_error').text(errors.name[0]).show();
                }
            }
        });
    } else {
        $.ajax({
            url: "/sizes/store",
            type: "POST",
            data: formData,
            success: function (response) {
                let sizeHtml = `
                <li class="roles-item" id="row-${response.size.slug}">
                    <div class="body-text">${response.size.name || '--'}</div>
                    <div class="list-icon-function">
                        <div class="item edit">
                            <a onclick="openEditSizeModal('${response.size.slug}')" data-size-id="${response.size.slug}">
                                <i class="icon-edit-3"></i>
                            </a>
                        </div>
                        <div class="item trash">
                            <a href="#" class="delete-user del_sizes" data-size-id="${response.size.slug}">
                                <i class="icon-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </li>`;

                // Append the new list item to the list
                $('#sizeTable').append(sizeHtml);

                // Close the modal
                closeSizeModal();

                // Show success notification
                Swal.fire({
                    title: 'Added!',
                    text: 'Size has been added.',
                    icon: 'success',
                    confirmButtonsize: '#3085d6',
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
                toastr.success('Size added successfully');
            },
            error: function (xhr, status, error) {
                // Handle error response
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

function closeSizeModal() {
    $('#size-modal').modal('hide');
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
    document.getElementById('sizeTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_sizes')) {
            event.preventDefault();
            const sizeId = event.target.closest('.del_sizes').dataset.sizeId;
            deleteSize(sizeId);
        }
    });
});
    function deleteSize(sizeId) {
        // Your delete logic here
        // console.log(`Delete category with ID: ${categoryId}`);
        openDeleteModalSize(sizeId);
        // For example, make an AJAX call to delete the category
    }
