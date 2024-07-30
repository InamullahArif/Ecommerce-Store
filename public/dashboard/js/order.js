function openDeleteModalOrder(id) {
    console.log(id);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log('id');
    Swal.fire({
        text: 'Are you sure you want to delete this order?',
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
                url: 'order/' + id + '/destroy',
                type: "GET",
                data: {},
                success: function(response) {
                    if (response.success) {
                        $('#row-' + response.order.id).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your order has been deleted.',
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
                            'Failed to delete order.',
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
                    toastr.success('Order deleted successfully');
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Failed to delete order.',
                        'error'
                    );
                }
            });
        }
    });
}
$(document).ready(function() {
    $('.del_order').on('click', function(event) {
        event.preventDefault();
        console.log('here');
        var id = $(this).data('order-id');
        console.log(id);
        openDeleteModalOrder(id);
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('orderTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_order')) {
            event.preventDefault();
            const orderId = event.target.closest('.del_order').dataset.orderId;
            // console.log(logId); return
            openDeleteModalOrder(orderId);
        }
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