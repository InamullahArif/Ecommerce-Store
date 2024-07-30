@extends('dashboard.welcome')
@section('content')
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    {{-- <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="/">
                                    <img class="" id="logo_header_mobile" alt="" src="images/logo/logo.png" data-light="images/logo/logo.png" data-dark="images/logo/logo-dark.png" data-width="154px" data-height="52px" data-retina="images/logo/logo@2x.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>
                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search" name="name" tabindex="2" value="" aria-required="true" required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search">
                                        <ul class="mb-24">
                                            <li class="mb-14">
                                                <div class="body-title">Top selling product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/17.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Dog Food Rachael Ray Nutrish®</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/18.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Natural Dog Food Healthy Dog Food</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/19.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Freshpet Healthy Dog Food and Cat</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="">
                                            <li class="mb-14">
                                                <div class="body-title">Order product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/20.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Sojos Crunchy Natural Grain Free...</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/21.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Kristin Watson</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/22.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/23.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <div class="header-grid">
                                <div class="header-item country">
                                    <select class="image-select no-text">
                                        <option data-thumbnail="images/country/1.png">ENG</option>
                                        <option data-thumbnail="images/country/9.png">VIE</option>
                                    </select>
                                </div>
                                <div class="header-item button-dark-light">
                                    <i class="icon-moon"></i>
                                </div>
                                <div class="popup-wrap noti type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton1" >
                                            <li>
                                                <h6>Message</h6>
                                            </li>
                                            <li>
                                                <div class="noti-item w-full wg-user active">
                                                    <div class="image">
                                                        <img src="images/avatar/user-11.png" alt="">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex items-center justify-between">
                                                            <a href="#" class="body-title">Cameron Williamson</a>
                                                            <div class="time">10:13 PM</div>
                                                        </div>
                                                        <div class="text-tiny">Hello?</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="noti-item w-full wg-user active">
                                                    <div class="image">
                                                        <img src="images/avatar/user-12.png" alt="">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex items-center justify-between">
                                                            <a href="#" class="body-title">Ralph Edwards</a>
                                                            <div class="time">10:13 PM</div>
                                                        </div>
                                                        <div class="text-tiny">Are you there?  interested i this...</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="noti-item w-full wg-user active">
                                                    <div class="image">
                                                        <img src="images/avatar/user-13.png" alt="">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex items-center justify-between">
                                                            <a href="#" class="body-title">Eleanor Pena</a>
                                                            <div class="time">10:13 PM</div>
                                                        </div>
                                                        <div class="text-tiny">Interested in this loads?</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="noti-item w-full wg-user active">
                                                    <div class="image">
                                                        <img src="images/avatar/user-11.png" alt="">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex items-center justify-between">
                                                            <a href="#" class="body-title">Jane Cooper</a>
                                                            <div class="time">10:13 PM</div>
                                                        </div>
                                                        <div class="text-tiny">Okay...Do we have a deal?</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="#" class="tf-button w-full">View all</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-message-square"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton2" >
                                            <li>
                                                <h6>Notifications</h6>
                                            </li>
                                            <li>
                                                <div class="message-item item-1">
                                                    <div class="image">
                                                        <i class="icon-noti-1"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Discount available</div>
                                                        <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus at, ullamcorper nec diam</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-2">
                                                    <div class="image">
                                                        <i class="icon-noti-2"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Account has been verified</div>
                                                        <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus et</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-3">
                                                    <div class="image">
                                                        <i class="icon-noti-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order shipped successfully</div>
                                                        <div class="text-tiny">Integer aliquam eros nec sollicitudin sollicitudin</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-4">
                                                    <div class="image">
                                                        <i class="icon-noti-4"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order pending: <span>ID 305830</span></div>
                                                        <div class="text-tiny">Ultricies at rhoncus at ullamcorper</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="#" class="tf-button w-full">View all</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="header-item button-zoom-maximize">
                                    <div class="">
                                        <i class="icon-maximize"></i>
                                    </div>
                                </div>
                                <div class="popup-wrap apps type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <i class="icon-grid"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton4" >
                                            <li>
                                                <h6>Related apps</h6>
                                            </li>
                                            <li>
                                                <ul class="list-apps">
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-1.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Photoshop</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-2.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">illustrator</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-3.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Sheets</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-4.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Gmail</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-5.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Messenger</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-6.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Youtube</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-7.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Flaticon</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-8.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">Instagram</div>
                                                        </a>
                                                    </li>
                                                    <li class="item">
                                                        <div class="image">
                                                            <img src="images/apps/item-9.png" alt="">
                                                        </div>
                                                        <a href="#">
                                                            <div class="text-tiny">PDF</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#" class="tf-button w-full">View all app</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="images/avatar/user-1.png" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    <span class="body-title mb-2">Kristin Watson</span>
                                                    <span class="text-tiny">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3" >
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="setting.html" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-settings"></i>
                                                    </div>
                                                    <div class="body-title-2">Setting</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-headphones"></i>
                                                    </div>
                                                    <div class="body-title-2">Support</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="login.html" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-log-out"></i>
                                                    </div>
                                                    <div class="body-title-2">Log out</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /header-dashboard -->
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Assign Permissions to users</h3>
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
                                            <div class="text-tiny">Assign permissions to users</div>
                                        </li>
                                    </ul>
                                </div>
                                {{-- {{dd($roles)}} --}}
                                <!-- create-roles -->
                                <form class="form-create-role" id="assignUserPermission">
                                  @csrf
                                    <div class="wg-box mb-24">
                                        {{-- <fieldset class="name">
                                            <div class="body-title mb-10">Name</div>
                                            <input class="flex-grow" type="text" placeholder="name" @if (isset($roles['name'])) value="{{ $roles['name'] }}" 
                                            @else value="{{ old('name') }}" @endif name="name" tabindex="0" value="" aria-required="true" required="">
                                        </fieldset> --}}
                                        {{-- {{dd($rolesAndPermissions)}} --}}
                                        <fieldset class="name">
                                            <div class="body-title mb-10">Users</div>
                                            <select class="flex-grow" name="user_id" id="user_id" tabindex="0" aria-required="true" required="">
                                                <option value="" disabled selected>Select a user</option>
                                                @foreach ($rolesAndPermissions['users'] as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
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
                                            {{-- <ul class="flex flex-column">
                                                <li class="item gap20 wrap-checkbox">
                                                    <div class="body-text">Users</div>
                                                    <div class="flex items-center gap10">
                                                        <input class="total-checkbox" type="checkbox">
                                                        <label class=""><div class="body-text">All</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox">
                                                        <label class=""><div class="body-text">Index</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox">
                                                        <label class=""><div class="body-text">Create</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox">
                                                        <label class=""><div class="body-text">Edit</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox">
                                                        <label class=""><div class="body-text">Delete</div></label>
                                                    </div>
                                                </li>
                                            </ul> --}}
                                           
                                            {{-- <ul class="flex flex-column">
                                                <li class="item gap20 wrap-checkbox">
                                                    <div class="body-text">Users</div>
                                                    <div class="flex items-center gap10">
                                                        <input class="total-checkbox" type="checkbox" name="permissions[]" value="users_all">
                                                        <label class=""><div class="body-text">All</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox" name="permissions[]" value="users_index">
                                                        <label class=""><div class="body-text">Index</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox" name="permissions[]" value="users_create">
                                                        <label class=""><div class="body-text">Create</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox" name="permissions[]" value="users_edit">
                                                        <label class=""><div class="body-text">Edit</div></label>
                                                    </div>
                                                    <div class="flex items-center gap10">
                                                        <input class="checkbox-item" type="checkbox" name="permissions[]" value="users_delete">
                                                        <label class=""><div class="body-text">Delete</div></label>
                                                    </div>
                                                </li>
                                            </ul> --}}
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
                                                        <input class="total-checkbox allcheck" id="module-{{ $moduleId}}" type="checkbox" name="permissions[]" >
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
                                <!-- /create-roles -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        <!-- bottom-page -->
                        {{-- <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 Remos. Design with</div>
                            <i class="icon-heart"></i>
                            <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All rights reserved.</div>
                        </div> --}}
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
                </div>
                <!-- /section-content-right -->
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    $(document).on('change', '#role_id', function () {
        var roleId = $(this).val();
        console.log(roleId);
        if (roleId) {
            $.ajax({
                type: 'GET',
                url: '/get-permissions/' + roleId,
                success: function (data) {
                    console.log(data.data);
                    $('.checkbox-item').prop('checked', false);
                    data.data.forEach(function(permissionName) {
                        $('input.checkbox-item[value="' + permissionName + '"]').prop('checked', true);
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});




</script> --}}


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script>
  $(document).ready(function () {
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
</script> --}}