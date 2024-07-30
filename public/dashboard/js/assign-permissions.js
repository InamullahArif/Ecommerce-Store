$(document).ready(function () {
    $(document).on('change', '#role_id', function () {
        var roleId = $(this).val();
        console.log(roleId);
        if (roleId) {
            $.ajax({
                type: 'GET',
                url: '/permissions/get/' + roleId,
                success: function (response) {
                    console.log(response);
                    $('.allcheck_role').prop('checked', false);
                    $('.checkbox-item').prop('checked', false);
                    var count = 0;
                    for (let groupId in response.data) {
                    if (response.data.hasOwnProperty(groupId)) {
                        // console.log(groupId);
                        let permissions = response.data[groupId];
                        
                        // console.log(labelSelector);
                        permissions.forEach(function(permissionName) {
                            $('.checkB[value="' + permissionName.name + '"]').prop('checked', true);
                        });
                        var labelSelector = $('label[id="module-' + groupId + '"]');
                        console.log(labelSelector);
                        if(labelSelector)
                        {
                            // labelSelector.prop('checked',true);
                            $('#module-' + groupId).prop('checked', true);
                        }
                    }
                }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
    $('#assignPermission').on('submit', function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize(); 
        console.log(formData);
        $.ajax({
            url: '/permissions/assign', 
            type: 'POST', 
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val() 
            },
            success: function(response) {
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
                    toastr.success('Permissions updated successfully');
            },
            error: function(xhr) {
                // alert('An error occurred while updating permissions.');
                console.log(xhr.responseText);
            }
        });
    });
    $(document).on('change', '#user_id', function () {
        var userId = $(this).val();
        console.log(userId);
        if (userId) {
            $.ajax({
                type: 'GET',
                url: '/permissions/get/user/' + userId,
                success: function (response) {
                    // console.log(response.data);
                    // var count = 0;
                    // $('.checkbox-item').prop('checked', false);
                    // response.data.forEach(function(name) {
                        // console.log("Checking: " + name.name);
                        // count++;
                        // $('.checkB[value="' + name.name + '"]').prop('checked', true);
                    // });
                    // if(count == 4)
                    // {
                    //     $('.allcheck').prop('checked', true);
                    // }else
                    // {
                    //     $('.allcheck').prop('checked', false);
                    // }
                    console.log(response);
                    $('.allcheck').prop('checked', false);
                    $('.checkbox-item').prop('checked', false);
                    var count = 0;
                    for (let groupId in response.data) {
                    if (response.data.hasOwnProperty(groupId)) {
                        // console.log(groupId);
                        let permissions = response.data[groupId];
                        
                        // console.log(labelSelector);
                        permissions.forEach(function(permissionName) {
                            $('.checkB[value="' + permissionName.name + '"]').prop('checked', true);
                        });
                        var labelSelector = $('label[id="module-' + groupId + '"]');
                        console.log(labelSelector);
                        if(labelSelector)
                        {
                            // labelSelector.prop('checked',true);
                            $('#module-' + groupId).prop('checked', true);
                        }
                    }
                }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
    $('#assignUserPermission').on('submit', function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize(); 
        console.log(formData);
        $.ajax({
            url: '/permissions/assign/user/', 
            type: 'POST', 
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val() 
            },
            success: function(response) {
                // alert('Permissions updated successfully.');
                // console.log(response);
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
                    toastr.success('Permissions updated successfully');
            },
            error: function(xhr) {
                // alert('An error occurred while updating permissions.');
                console.log(xhr.responseText);
            }
        });
    });
});

