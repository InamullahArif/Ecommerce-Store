@extends('dashboard.welcome')
@section('content')
                <div class="section-content-right">
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Assign Permissions to roles</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="/"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Roles</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Assign permissions to roles</div>
                                        </li>
                                    </ul>
                                </div>
                                <form class="form-create-role" id="assignPermission" >
                                  @csrf
                                    <div class="wg-box mb-24">
                                        <fieldset class="name">
                                            <div class="body-title mb-10">Roles</div>
                                            <select class="flex-grow" name="role_id" id="role_id" tabindex="0" aria-required="true" required="">
                                                <option value="" disabled selected>Select a role</option>
                                                @foreach ($rolesAndPermissions['roles'] as $role)
                                                    <option value="{{ $role->id }}" @if(isset($roles['name']) && $roles['name'] == $role->name) selected @endif>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        <div class="wg-table table-create-role">
                                            <ul class="table-title flex gap20 mb-14">
                                                <li>
                                                    <div class="body-title">Permissions</div>
                                                </li>    
                                            </ul>
                                                @foreach($rolesAndPermissions['permissions'] as $moduleId => $permissions)
                                                <ul class="flex flex-column">
                                                    <li class="item gap20 wrap-checkbox">
                                                        {{-- <div class="body-text">{{ ucfirst($moduleId) }}</div> --}}
                                                        {{-- <div class="body-text">
                                                            @if($moduleId == 1)
                                                                Users
                                                            @elseif($moduleId == 2)
                                                                Roles
                                                            @else
                                                                Assign
                                                            @endif
                                                        </div> --}}
                                                         <div class="flex items-center gap10">
                                                        <input class="total-checkbox allcheck_role" id="module-{{ $moduleId}}" type="checkbox" name="permissions[]" >
                                                        <label class=""><div class="body-text" >@if($moduleId == 1)
                                                            Users
                                                        @elseif($moduleId == 2)
                                                            Roles
                                                        @else
                                                            Assign
                                                        @endif</div></label>
                                                    </div>
                                                        @foreach($permissions as $permission)
                                                        {{-- {{dd($permission)}} --}}
                                                            <div class="flex items-center gap10">
                                                                <input class="checkbox-item checkB" type="checkbox" id="module-{{ $moduleId }}" name="permissions[]" value="{{ $permission['name'] }}">
                                                                <label class=""><div class="body-text">{{ ucfirst(str_replace('_', ' ', $permission['name'])) }}</div></label>
                                                            </div>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <button class="tf-button w180" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /main-content -->
                </div>
                <!-- /section-content-right -->
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script>
  $(document).ready(function () {
    // $(document).on('change', '#role_id', function () {
    //     var roleId = $(this).val();
    //     console.log(roleId);
    //     if (roleId) {
    //         $.ajax({
    //             type: 'GET',
    //             url: '/permissions/get/' + roleId,
    //             success: function (response) {
    //                 console.log(response);
    //                 $('.checkbox-item').prop('checked', false);
    //                 var count = 0;
    //                 response.data.forEach(function(name) {
                        // count++;
                        // console.log("Checking: " + name.name);
                        // $('.checkB[value="' + name.name + '"]').prop('checked', true);
                    // });
                    // $('.checkB[value="' + response.data.name + '"]').prop('checked',false);
                    // if(count == 4)
                    // {
                    //     $('.allcheck').prop('checked', true);
                    // }
                    // else
                    // {
                    //     $('.allcheck').prop('checked', false);
                    // }
                // },
                // error: function (xhr, status, error) {
                    // console.error(xhr.responseText);
                // }
            // });
        // }
    // });


    $(document).on('change', '#role_id', function () {
        var roleId = $(this).val();
        console.log(roleId);
        if (roleId) {
            $.ajax({
                type: 'GET',
                url: '/permissions/get/' + roleId,
                success: function (response) {
                    console.log(response);
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
}); --}}




{{-- </script> --}}