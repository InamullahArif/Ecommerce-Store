@extends('dashboard.welcome')
@section('content')
{{-- <style>
    .new:hover{
        background-color: red;
    }
</style> --}}
    {{-- {{dd($users->image)}} --}}
    <!-- section-content-right -->
    <div class="section-content-right">

        <!-- main-content -->
        <div class="main-content">
            <!-- main-content-wrap -->
            <div class="main-content-inner">
                <!-- main-content-wrap -->
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>All Notifications</h3>
                        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                            <li>
                                <a href="/">
                                    <div class="text-tiny">Dashboard</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="text-tiny">Notification</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">All Notifications</div>
                            </li>
                        </ul>
                    </div>
                    {{-- <div>
                                    @if (Session::has('message'))
                                        <div class="block-warning type-main w-full">
                                            <i class="icon-check-circle"></i>
                                            <div class="body-title-2">{{ Session::get('message') }}</div>
                                        </div>
                                    @endif
                                </div> --}}
                    {{-- <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Dashboard</div>
                                                <div class="panel-body">
                                                    Check for notification
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                    {{-- <div class="position-relative">
                                    <input type="search" data-table="leadTable" id="source_search" oninput="searchResource()" class="form-control to" value="">
                                    <img src="{{ asset('images/images/search-icon.svg') }}" alt="">
                                </div> --}}
                    <!-- all-user -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <form class="form-search">
                                    <fieldset class="name">
                                        <input type="search" data-table="notificationTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search notification here..." class=""
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            {{-- @can('create_users')
                            <a class="tf-button style-1 w208" href="{{ route('users.create') }}"><i
                                    class="icon-plus"></i>Add User</a>
                            @endcan --}}
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">Name</div>
                                </li>
                                <li>
                                    <div class="body-title">Detail</div>
                                </li>
                                <li>
                                    <div class="body-title">Created At</div>
                                </li>
                                <li>
                                    <div class="body-title">Mark as Read</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="notificationTable">
                                {{-- {{dd($users)}} --}}
                                @if (isset($notifications))
                                    @foreach ($notifications as $notification)
                                    {{-- <div class="new"> --}}
                                        <li class="user-item gap14" id="row-{{ $notification['id'] }}" >
                                            <div class="flex items-center justify-between  flex-grow">
                                                <div style="max-width: 160px">
                                                    <div class="body-text mt-3" style="@if ($notification->is_read == false) color: red @else color:green @endif" id="notification_{{ $notification->id }}">{{ $notification['name'] ?? '--' }}</div>
                                                </div>

                                                <div class="body-text">{{ $notification['detail'] ?? '--' }}</div>
                                                <div class="body-text" style="padding-left:25px;">{{ \Carbon\Carbon::parse($notification['created_at'])->setTimezone('Asia/Karachi')->format('jS F, Y g:ia') }}</div>
                                                <div style="display: flex; font-size:15px; padding-left:10px">
                                                    <button class="mark-as-read badge @if ($notification->is_read == true) badge-primary
                                                        @else badge-secondary @endif" id="noti" style="width:88px;" data-notification-id="{{ $notification->id }}">@if ($notification->is_read == true) Read @else Mark as Read @endif</button>
                                                </div>     
                                                <div class="list-icon-function">
                                                    <div class="item trash">
                                                        <a href="#" class="delete-user del_notifications"
                                                            data-notification-id="{{ $notification['id'] }}">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    {{-- </div> --}}
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px">No notification found</div>
                                @endif
                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $notifications->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $notifications->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $notifications->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                    <li class="{{ $notifications->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $notifications->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ $notifications->currentPage() == $notifications->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $notifications->nextPageUrl() }}">
                                        <i class="icon-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <!-- /all-user -->
                </div>
                <!-- /main-content-wrap -->
            </div>
            <!-- /main-content-wrap -->
            <!-- bottom-page -->
            {{-- <div class="bottom-page">
                <div class="body-text">Copyright © 2024 Remos. Design with</div>
                <i class="icon-heart"></i>
                <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All
                    rights reserved.</div>
            </div> --}}
            <!-- /bottom-page -->
        </div>
        <!-- /main-content -->
    </div>
    <!-- /section-content-right -->
    @include('dashboard.delete-modal')
@endsection
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

{{-- <script>
    function openDeleteModal(userId) {
        console.log(userId);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        Swal.fire({
            text: 'Are you sure you want to delete this user?',
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
                    url: '/users/' + userId,
                    type: "DELETE",
                    data: {},
                    success: function(response) {
                        if (response.success) {
                            $('#row-' + response.user.id).remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your user has been deleted.',
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
                    },
                    error: function() {
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
        $('.del').on('click', function(event) {
            event.preventDefault();
            // console.log('here');
            var userId = $(this).data('user-id');
            // console.log(userId);
            openDeleteModal(userId);
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
</script> --}}
{{-- <style>
    .swal-button-size {
        font-size: 1.2em;
        padding: 10px 20px;
    }
</style> --}}
{{-- <script>
    function openDeleteModal(notificationId) {
        console.log(notificationId);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

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
    } --}}
    {{-- function searchResource() {
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
    } --}}
    {{-- function updateNotificationsCount()
    {
        $.ajax({
            url: '/notifications-count',
            method: 'GET',
            success: function(response) {
                console.log(response);
                $('#noti_count').text(response.notification_count); // Update the notifications count
            },
            error: function() {
                alert('Error in fetching notifications count.');
            }
        });
    } --}}
    
    {{-- $(document).ready(function() {
        $('.mark-as-read').on('click', function(e) {
            e.preventDefault();
    
            var notificationId = $(this).data('notification-id');
            var button = $(this);
    
            $.ajax({
                url: '/mark-as-read', 
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: notificationId
                },
                success: function(response) {
                    if (response.success) {
                        $("#noti").prop('disabled', true).text('Read');
                        // console.log($('#notification_link_' + notificationId));
                        var notificationLink = $('#notification_' + notificationId);
                        if (notificationLink.length) {
                            notificationLink.css('color', 'green');
                        } else {
                            console.error('Notification link not found for ID:', notificationId);
                        }
                        // $('#notification_link_' + notificationId).css('color', 'green');
                        notificationId.css('color','green');
                        updateNotificationsCount();

                        // $('#notification_link_' + notificationId).css('color', 'green');
                        // button.prop('disabled', true).text('Read'); 
                        // $('#notification_' + notificationId).css('color', 'green');
                        
                        // Change the color and text of the button
                        // button.css('color', 'green').prop('disabled', true).text('Read');
                    } else {
                        alert('Failed to mark notification as read.');
                    }
                },
                error: function() {
                    alert('Error in marking notification as read.');
                }
            });
        });

        $('.del').on('click', function(event) {
            event.preventDefault();
            // console.log('here');
            var notificationId = $(this).data('notification-id');
            // console.log(userId);
            openDeleteModal(notificationId);
        });
    }); --}}
    {{-- </script> --}}
