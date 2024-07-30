@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>{!! __(!empty($users) ? 'Update User' : 'Add New User') !!}</h3>
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
                                <div class="text-tiny">{!! __(!empty($users) ? 'Update User' : 'Add New User') !!}</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="addUser" name="addUser" method="POST"
                        enctype="multipart/form-data"
                        action="{{ !empty($users['id']) ? route('users.update', $users['id']) : route('users.store') }}">
                        @csrf
                        @if (!empty($users['id']))
                            @method('PUT')
                        @endif
                        <div class="wg-box">
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Name</div>
                                    <input class="flex-grow" type="text" placeholder="Username"
                                        @if (isset($users['name'])) value="{{ $users['name'] }}" 
                                                @else value="{{ old('name') }}" @endif
                                        name="name" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('name')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Roles</div>
                                    <select class="flex-grow" name="role_id" tabindex="0" aria-required="true"
                                        required="">
                                        <option value="" disabled selected>Select a role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if (isset($rol) && ($rol->name ? $rol->name === $role->name : false)) selected @endif>

                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </fieldset>
                                {{-- <fieldset class="name">
                                                <div class="body-title mb-10">Roles</div>
                                                <select class="flex-grow" name="role_id" tabindex="0" aria-required="true" required="">
                                                    <option value="" disabled>Select a role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" 
                                                            @if (old('role_id') == $role->id) selected @endif>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset> --}}
                                <fieldset class="email mb-24">
                                    <div class="body-title mb-10" style="margin-top: 22px">Email</div>
                                    <input class="flex-grow" type="email" placeholder="Email"
                                        @if (isset($users['email'])) value="{{ $users['email'] }}" 
                                                @else value="{{ old('email') }}" @endif
                                        name="email" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('email')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="password mb-24">
                                    <div class="body-title mb-10">Password</div>
                                    <input class="password-input" type="password" value="{{ old('password') }}"
                                        placeholder="Enter password" name="password" tabindex="0" value=""
                                        aria-required="true" style="margin-bottom: 6px">
                                    <span class="show-pass">
                                        <i class="icon-eye view"></i>
                                        <i class="icon-eye-off hide"></i>
                                    </span>
                                    @error('password')
                                        <span style="color: red; font-size: 15px;">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Phone Number</div>
                                    <input class="flex-grow" type="text" placeholder="03*********"
                                        @if (isset($users['phone_number'])) value="{{ $users['phone_number'] }}" 
                                                @else value="{{ old('phone_number') }}" @endif
                                        name="phone_number" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px">
                                    @error('phone_number')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="image mb-24">
                                    <div class="body-title mb-10">Profile Image</div>
                                    <input type="file" name="image" accept="image/*" tabindex="0"
                                        aria-required="true">
                                    @error('image')
                                        <br></br>
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                {{-- @if (isset($users->image->name))
                                                <img src="{{ $users->image->name }}" alt="Profile Image" style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                            @endif --}}
                                @if (isset($users->image->name))
                                    <img src="{{ asset($users->image->name ?? '') }}" alt="Profile Image"
                                        style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                @else
                                    <input type="hidden" name="image_url" value="{{ asset('user_images/user.jpg') }}">
                                @endif
                                {{-- @error('image')
                                                    <div class="alert alert-danger" style="font-size:15px">{{ $message }}</div>
                                                @enderror --}}
                            </div>
                        </div>
                        {{-- <div class="wg-box">
                                        <div class="left">
                                            <h5 class="mb-4">Pernission</h5>
                                            <div class="body-text">Items that the account is allowed to edit</div>
                                        </div>
                                        <div class="right flex-grow">
                                            <fieldset class="mb-24">
                                                <div class="body-title mb-10">Add product</div>
                                                <div class="radio-buttons">
                                                    <div class="item">
                                                        <input class="" type="radio" name="add-product" id="add-product1" checked>
                                                        <label class="" for="add-product1"><span class="body-title-2">Allow</span></label>
                                                    </div>
                                                    <div class="item">
                                                        <input class="" type="radio" name="add-product" id="add-product2">
                                                        <label class="" for="add-product2"><span class="body-title-2">Deny</span></label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-24">
                                                <div class="body-title mb-10">Update product</div>
                                                <div class="radio-buttons">
                                                    <div class="item">
                                                        <input class="" type="radio" name="update-product" id="update-product1">
                                                        <label class="" for="update-product1"><span class="body-title-2">Allow</span></label>
                                                    </div>
                                                    <div class="item">
                                                        <input class="" type="radio" name="update-product" id="update-product2" checked>
                                                        <label class="" for="update-product2"><span class="body-title-2">Deny</span></label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-24">
                                                <div class="body-title mb-10">Delete product</div>
                                                <div class="radio-buttons">
                                                    <div class="item">
                                                        <input class="" type="radio" name="delete-product" id="delete-product1" checked>
                                                        <label class="" for="delete-product1"><span class="body-title-2">Allow</span></label>
                                                    </div>
                                                    <div class="item">
                                                        <input class="" type="radio" name="delete-product" id="delete-product2">
                                                        <label class="" for="delete-product2"><span class="body-title-2">Deny</span></label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="mb-24">
                                                <div class="body-title mb-10">Apply discount</div>
                                                <div class="radio-buttons">
                                                    <div class="item">
                                                        <input class="" type="radio" name="apply-product" id="apply-product1">
                                                        <label class="" for="apply-product1"><span class="body-title-2">Allow</span></label>
                                                    </div>
                                                    <div class="item">
                                                        <input class="" type="radio" name="apply-product" id="apply-product2" checked>
                                                        <label class="" for="apply-product2"><span class="body-title-2">Deny</span></label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="">
                                                <div class="body-title mb-10">Create coupon</div>
                                                <div class="radio-buttons">
                                                    <div class="item">
                                                        <input class="" type="radio" name="create-product" id="create-product1">
                                                        <label class="" for="create-product1"><span class="body-title-2">Allow</span></label>
                                                    </div>
                                                    <div class="item">
                                                        <input class="" type="radio" name="create-product" id="create-product2" checked>
                                                        <label class="" for="create-product2"><span class="body-title-2">Deny</span></label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div> --}}
                        <div class="bot">
                            <button class="tf-button w180" type="submit">Save</button>
                        </div>

                    </form>
                    <!-- /add-new-user -->
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
