function openDeleteModalBlog(slug) {
    console.log(slug);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log('blog');
    Swal.fire({
        text: 'Are you sure you want to delete this blog?',
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
                url: 'blog/' + slug + '/destroy',
                type: "GET",
                data: {},
                success: function(response) {
                    if (response.success) {
                        $('#row-' + response.blog.id).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your blog has been deleted.',
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
                            'Failed to delete blog.',
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
                    toastr.success('Blog deleted successfully');
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Failed to delete blog.',
                        'error'
                    );
                }
            });
        }
    });
}


$(document).ready(function() {
    $('.del_blog').on('click', function(event) {
        event.preventDefault();
        console.log('here');
        var slug = $(this).data('blog-id');
        console.log(slug);
        openDeleteModalBlog(slug);
    });
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
    document.getElementById('blogTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_blog')) {
            event.preventDefault();
            const blogId = event.target.closest('.del_blog').dataset.blogId;
            // console.log(logId); return
            openDeleteModalBlog(blogId);
        }
    });
});