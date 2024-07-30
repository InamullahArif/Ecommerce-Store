function openDeleteModalLog(logId) {
    console.log(logId);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log('log');
    Swal.fire({
        text: 'Are you sure you want to delete this log?',
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
                url: '/logs/' + logId,
                type: "GET",
                data: {},
                success: function(response) {
                    if (response.success) {
                        $('#row-' + response.log.id).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Log has been deleted.',
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
                            'Failed to delete log.',
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
                toastr.success('Log deleted successfully');
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Failed to delete log.',
                        'error'
                    );
                }
            });
        }
    });
}


$(document).ready(function() {
    $('.del_log').on('click', function(event) {
        event.preventDefault();
        console.log('here');
        var logId = $(this).data('log-id');
        console.log(logId);
        openDeleteModalLog(logId);
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('logTable').addEventListener('click', function(event) {
        if (event.target.closest('.del_log')) {
            event.preventDefault();
            const logId = event.target.closest('.del_log').dataset.logId;
            // console.log(logId); return
            openDeleteModalLog(logId);
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
    // console.log('into logs');
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