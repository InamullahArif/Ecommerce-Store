@extends('dashboard.welcome')
@section('content')
{{-- <script src="{{ asset('dashboard/js/users.js') }}"></script> --}}
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
                        <h3>All Users</h3>
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
                                    <div class="text-tiny">User</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">All User</div>
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
                                        <input type="search" data-table="userTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search user here..." class=""
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            @can('create_users')
                            <a class="tf-button style-1 w208" href="{{ route('users.create') }}"><i
                                    class="icon-plus"></i>Add User</a>
                            @endcan
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">User</div>
                                </li>
                                <li>
                                    <div class="body-title">Email</div>
                                </li>
                                <li>
                                    <div class="body-title">Phone Number</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="userTable">
                                {{-- {{dd($users)}} --}}
                                @if (isset($users))
                                    @foreach ($users as $user)
                                        <li class="user-item gap14" id="row-{{ $user['id'] }}">
                                            <div class="image">
                                                <img src="images/avatar/user-6.png" alt="">
                                            </div>
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                <div style="max-width: 195px">
                                                    {{-- @php
                                                        if ($user['image_id'] != null) {
                                                            $imageId = $user['image_id'];
                                                            $image = App\Models\Image::find($imageId);
                                                            if ($image) {
                                                                $imgUrl = asset('user_images/' . $image->name);
                                                            } else {
                                                                $imgUrl = null;
                                                            }
                                                        } else {
                                                            $imgUrl = null;
                                                        }
                                                    @endphp
                                                    @if ($imgUrl)
                                                        <div class="image">
                                                            <img src="{{ $imgUrl }}" class="body-title-2"
                                                                style="border-radius: 10%;">
                                                        </div>
                                                    @else
                                                        <div class="text-tiny mt-3">{{ '--' }}</div>
                                                    @endif --}}
                                                    {{-- <a href="#" class="body-title-2">{{$users->image->name ?? '--'}}</a> --}}
                                                    <div class="image">
                                                        <img src="{{ $user->image->name ?? '' }}" class="body-title-2"
                                                            style="border-radius: 10%;">
                                                    </div>
                                                    <div class="text-tiny mt-3">{{ $user['name'] ?? '--' }}</div>
                                                </div>

                                                <div class="body-text">{{ $user['email'] ?? '--' }}</div>
                                                <div class="body-text">{{ $user['phone_number'] ?? '--' }}</div>
                                                <div class="list-icon-function">
                                                    @can('view_users')
                                                    <div class="item eye">
                                                        <a href="{{ route('users.show', $user['id']) }}">
                                                            <i class="icon-eye"></i>
                                                        </a>

                                                    </div>
                                                    @endcan
                                                    @can('edit_users')
                                                    <div class="item edit">
                                                        <a href="{{ route('users.edit', $user['id']) }}">
                                                            <i class="icon-edit-3"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @can('delete_users')
                                                    <div class="item trash">
                                                        <a href="#" class="delete-user del_user"
                                                            data-user-id="{{ $user['id'] }}">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px">No user found</div>
                                @endif
                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $users->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $users->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $users->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <li class="{{ $users->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $users->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $users->nextPageUrl() }}">
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
