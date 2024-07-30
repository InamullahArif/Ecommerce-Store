{/* <script> */}
   function openDeleteModal(roleId) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log('role');
    Swal.fire({
        text: 'Are you sure you want to delete this role?',
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
                url: '/roles/' + roleId,
                type: "DELETE",
                data: {},

                success: function (response) {
                    if (response.success) {
                        $('#row-' + response.role.id).remove();
                        Swal.fire({
                        title: 'Deleted!',
                        text: 'Your role has been deleted.',
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
                            'Failed to delete user.',
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
                    toastr.success('Role deleted successfully');
                },
                error: function () {
                    Swal.fire(
                        'Error!',
                        'Failed to delete user.',
                        'error'
                    );
                }
            });
        }
    });
}


    $(document).ready(function() {
        $('.del_roles').on('click',function(event) {
            event.preventDefault();
            // console.log('here');
            var roleId = $(this).data('role-id');
            // console.log(userId);
            openDeleteModal(roleId);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('roleTable').addEventListener('click', function(event) {
            console.log(event.target.closest('.del_roles'));
            if (event.target.closest('.del_roles')) {
                event.preventDefault();
                // console.log('here1');
                const roleId = event.target.closest('.del_roles').dataset.roleId;
                console.log(roleId); return
                openDeleteModalUser(userId);
            }
        });
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
            // $("#" + table + " tbody tr").remove();
            // $("#" + table + " tbody").append(response.data);
            // $(".paginationLinks").html(response.pagination);
            if(response.success)
            {
                $("#" + table).empty();
            // Append the new data
            $("#" + table).append(response.data);
            }
           
        },
        error: function (response) {
            // debugger;
        },
    });
}


// </script>