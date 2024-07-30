$(document).ready(function () {
    
});
$('.del_categories').on('click', function (event) {
    event.preventDefault();
    // console.log('here');
    var categoryId = $(this).data('category-id');
    // console.log(categoryId);
    openDeleteModalCategory(categoryId);
});
function openDeleteModalCategory(categoryId) {
    // console.log(categoryId);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // console.log('category');
    Swal.fire({
        text: 'Are you sure you want to delete this category?',
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
                url: '/categories/' + categoryId,
                type: "DELETE",
                data: {},
                success: function (response) {
                    if (response.success) {
                        $('#row-' + response.category.id).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your category has been deleted.',
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
                            'Failed to delete category.',
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
                    toastr.success('Category deleted successfully');
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to delete category.',
                        'error'
                    );
                }
            });
        }
    });
}

function showCategoryModal() {
    $("#category_name").val('');
    $("#category_description").val('');
    $("#name_error").val('');
    $("#description_error").val('');
    $("#exampleModalCenterTitle").text("Add Category");
    $("#category-modal").modal('show');

}

function closeCategoryModal() {
    $("#category-modal").modal('hide');

}

function openEditCategoryModal(id) {
    $.ajax({
        url: "/categories/" + id + "/edit",
        type: "get",
        success: function (response) {
            // console.log(response.category.name);
            $("#category_name").val(response.category.name);
            $("#category_description").val(response.category.description);
            // $("#exampleModalCenterTitle").text("");
            $("#name_error").text('');
            $("#description_error").text('');
            $("#exampleModalCenterTitle").text("Edit Category");
            $("#category_id").val(response.category.id);
            $("#category_no").val();
            $("#category-modal").modal('show');
        },
        error: function (xhr, status, error) {
            // Handle error response
        }
    });
    // $("#category-modal").modal('hide');

}

function saveCategory() {
    var categoryId = $("#category_id").val();
    var categoryName = $("#category_name").val();
    var categoryDescription = $("#category_description").val();
    let formData = $("#category_form").serialize();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // console.log(categoryId, categoryName);
    if (categoryId) {
        $.ajax({
            url: "/categories/" + categoryId,
            type: "PUT",
            data: {
                name: categoryName,
                description: categoryDescription,
            },
            success: function (response) {
                console.log(response.category.id);
                if (response.success) {
                    $('#row-' + categoryId).remove();

                    let maxDescriptionLength = 80; // Define the maximum length for description

                    let updatedCategoryHtml = `
                    <li class="roles-item" id="row-${response.category.id}">
                        <div class="body-text">${response.category.name || '--'}</div>
                        <div class="body-text">
                            ${response.category.description.length > maxDescriptionLength ?
                                response.category.description.slice(0, maxDescriptionLength) + '...' :
                                response.category.description || '--'}
                        </div>
                        <div class="list-icon-function">
                            <div class="item edit">
                                <a onclick="openEditCategoryModal('${response.category.id}')" data-category-id="${response.category.id}">
                                    <i class="icon-edit-3"></i>
                                </a>
                            </div>
                            <div class="item trash">
                                <a href="#" class="delete-user del_categories" data-category-id="${response.category.id}">
                                    <i class="icon-trash-2"></i>
                                </a>
                            </div>
                        </div>
                    </li>`;
                
                    $('#categoryTable').append(updatedCategoryHtml);
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Your category has been updated.',
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
                    toastr.success('Category updated successfully');
                    $("#category-modal").modal('hide');
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
            url: "/categories",
            type: "POST",
            data: formData,
            success: function (response) {
                let maxDescriptionLength = 80; // Define the maximum length for description

                let categoryHtml = `
                <li class="roles-item" id="row-${response.category.id}">
                    <div class="body-text">${response.category.name || '--'}</div>
                    <div class="body-text">
                        ${response.category.description.length > maxDescriptionLength ?
                            response.category.description.slice(0, maxDescriptionLength) + '...' :
                            response.category.description || '--'}
                    </div>
                    <div class="list-icon-function">
                        <div class="item edit">
                            <a onclick="openEditCategoryModal('${response.category.id}')" data-category-id="${response.category.id}">
                                <i class="icon-edit-3"></i>
                            </a>
                        </div>
                        <div class="item trash">
                            <a href="#" class="delete-user del_categories" data-category-id="${response.category.id}">
                                <i class="icon-trash-2"></i>
                            </a>
                        </div>
                    </div>
                </li>`;

                // Append the new list item to the list
                $('#categoryTable').append(categoryHtml);

                // Close the modal
                closeCategoryModal();

                // Show success notification
                Swal.fire({
                    title: 'Added!',
                    text: 'Your category has been added.',
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
                toastr.success('Category added successfully');
            },
            error: function (xhr, status, error) {
                // Handle error response
            }
        });
    }

    // console.log('Category Name:', categoryName);

}

function closeCategoryModal() {
    $('#category-modal').modal('hide');
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
    document.getElementById('categoryTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_categories')) {
            event.preventDefault();
            const categoryId = event.target.closest('.del_categories').dataset.categoryId;
            deleteCategory(categoryId);
        }
    });
});
    function deleteCategory(categoryId) {
        // Your delete logic here
        // console.log(`Delete category with ID: ${categoryId}`);
        openDeleteModalCategory(categoryId);
        // For example, make an AJAX call to delete the category
    }
