$(document).ready(function() {
    $('.mark-as-read').on('click', function(e) {
        e.preventDefault();
        var notificationId = $(this).data('notification-id');
        // console.log($('notification_div_'+notificationId)); return
        // var button = $(this);
$.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: '/mark-as-read', // Replace with your actual URL
            method: 'POST',
            data: {
                id: notificationId
            },
            success: function(response) {
                if (response.success) {
                    console.log(notificationId);
                    // Change the color of the anchor tag
                    $('#notification_link_' + notificationId).css('color', 'green');
                    // button.prop('disabled', true).text('Read'); 
                    var notificationLink = $('#notification_' + notificationId);
                        if (notificationLink.length) {
                            notificationLink.css('color', 'green');
                        } else {
                            console.error('Notification link not found for ID:', notificationId);
                        }
                    $('#notification_div_'+notificationId).remove();
                    // $('#noti').text('Read');
                    // $('#noti').removeClass('badge-secondary');
                    // $('#noti').addClass('badge-primary');
                    var button = $('button[data-notification-id="' + notificationId + '"]');
                    button.removeClass('badge-secondary');
                    button.addClass('badge-primary');
                    updateNotificationsCount();
                } else {
                    alert('Failed to mark notification as read.');
                }
            },
            error: function() {
                alert('Error in marking notification as read.');
            }
        });
    });
    $('.del_notifications').on('click', function(event) {
        event.preventDefault();
        // console.log('here');
        var notificationId = $(this).data('notification-id');
        // console.log(userId);
        openDeleteModal(notificationId);
    });
    function openDeleteModal(notificationId) {
        // console.log(notificationId);
        // $.ajaxSetup({
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        // });
        console.log('notification');
        Swal.fire({
            text: 'Are you sure you want to delete this notification?',
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
                    url: '/notification/' + notificationId,
                    type: "GET",
                    data: {},
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#row-' + response.notification.id).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Notification has been deleted.',
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
                                'Failed to delete notification.',
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
                        toastr.success('Notification deleted successfully');
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Failed to delete notification.',
                            'error'
                        );
                    }
                });
            }
        });
    }
   
});
function searchResource() {
    var search = document.getElementById("source_search");
    // var department = document.getElementById("department_id");
    // var department_id;
    // if (department) department_id = department.value;
    var search_by_name = document.getElementById("source_search").value;
    table = search.getAttribute("data-table");
    var url = window.location.href.split('?')[0];
    console.log(url);
    // $.ajaxSetup({
    //     headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     },
    // });
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
function updateNotificationsCount()
{
    // var not\ificationId = $(this).closest('.noti-item').find('input[name="id"]').val();
    // console.log('Hidden input field ID:', notificationId);
    // console.log(notificationId);
    $.ajax({
        url: '/notifications-count',
        method: 'GET',
        success: function(response) {
            console.log(response);
            $('#noti_count').text(response.notification_count); // Update the notifications count
            // $('#notification_div_'. response.notifications.id).remove();
        },
        error: function() {
            alert('Error in fetching notifications count.');
        }
    });
}