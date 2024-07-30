@extends('dashboard.welcome')
@section('content')

    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>Manage Navbar</h3>
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
                                    <div class="text-tiny">Website</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">Navbar</div>
                            </li>
                        </ul>
                    </div>
                    @php
                        $image = $navs->image;
                        $navs = json_decode($navs->data);
                    @endphp
                    <form class="form-add-new-user form-style-2" id="editNavbar" name="editNavbar" method="POST"
                        enctype="multipart/form-data" action={{route('navbar.store')}}>
                        @csrf
                        <div class="wg-box"> 
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Logo</div>
                                    <img src="{{ asset($image->name ?? '') }}" alt=""
                                        style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                     <input type="file" name="image" accept="image/*" tabindex="0">
                                </fieldset>
                        <div id="fieldsets-container" class="vertical-container">
                            @if (!empty($navs))
                                @foreach ($navs as $nav)
                            <div class="fieldset-container" style="margin-top:20px;">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Name</div>
                                    <input class="flex-grow" type="text" value="{{ old('name.'.$loop->index, $nav->name) }}" placeholder="Name" name="name[]" tabindex="0" style="margin-bottom: 6px">
                                    @if ($errors->has("name.*"))
                                    @php
                                        $error = $errors->first("name.*");
                                        $error = str_replace('.0', '', $error);
                                    @endphp
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $error}}</span>
                                @endif
                                </fieldset>
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10" style="margin-top: 22px">Link</div>
                                    <input class="flex-grow" type="text" value="{{ old('link.'.$loop->index, $nav->link) }}" placeholder="Link" name="link[]" tabindex="0"  style="margin-bottom: 6px">
                                    @if ($errors->has("link.*"))
                                    @php
                                        $error = $errors->first("link.*");
                                        $error = str_replace('.0', '', $error);
                                    @endphp
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $error }}</span>
                                    @endif
                                </fieldset>
                                <button type="button" class="tf-button remove-btn" onclick="removeFieldset(this)">Remove</button>
                                <button type="button" class="tf-button add-subfield-btn" style="margin-top:5px;" onclick="addSubField(this, {{$loop->index}})">Add Sub Field</button>
                                <div class="subfield-container">
                                    @if (!empty($nav->subfields))
                                        @foreach ($nav->subfields as $subfield)
                                            <div class="subfield fieldset-container" style="margin-left: 40px; margin-top: 10px;">
                                                <fieldset class="name mb-24">
                                                    <div class="body-title mb-10">Sub Name</div>
                                                    <input class="flex-grow" type="text" value="{{ old('sub_name.'.$loop->parent->index.'.'.$loop->index, $subfield->sub_name) }}" placeholder="Sub Name" name="sub_name[{{$loop->parent->index}}][]" tabindex="0" style="margin-bottom: 6px">
                                                </fieldset>
                                                <fieldset class="name mb-24">
                                                    <div class="body-title mb-10" style="margin-top: 22px">Sub Link</div>
                                                    <input class="flex-grow" type="text" value="{{ old('sub_link.'.$loop->parent->index.'.'.$loop->index, $subfield->sub_link) }}" placeholder="Sub Link" name="sub_link[{{$loop->parent->index}}][]" tabindex="0" style="margin-bottom: 6px">
                                                </fieldset>
                                                <button type="button" class="tf-button remove-btn" onclick="removeFieldset(this)">Remove</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="fieldset-container" style="margin-top:10px;">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Name</div>
                                    <input class="flex-grow" type="text" placeholder="Name"  name="name[]" tabindex="0"   style="margin-bottom: 6px">
                                </fieldset>
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10" style="margin-top: 22px">Link</div>
                                    <input class="flex-grow" type="text" placeholder="Link" name="link[]"  tabindex="0"  style="margin-bottom: 6px">
                                </fieldset>
                                <button type="button" class="tf-button remove-btn" onclick="removeFieldset(this)">Remove</button>
                                <button type="button" class="tf-button add-subfield-btn" style="margin-top:5px;" onclick="addSubField(this, 0)">Add Sub Field</button>
                                <div class="subfield-container"></div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                        <button type="button" class="tf-button" id="add-new-record-btn">Add New Record</button>
                        <div class="bot">
                            <button class="tf-button w180" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-new-record-btn').click(function() {
                addNewFieldset();
            });
        });

        function addNewFieldset() {
            let index = $('.fieldset-container').length;
            let fieldsetHTML = `
            <div class="fieldset-container" style="margin-top:20px;">
                <fieldset class="name mb-24">
                    <div class="body-title mb-10">Name</div>
                    <input class="flex-grow" type="text" placeholder="Name" name="name[${index}]" tabindex="0" style="margin-bottom: 6px">
                </fieldset>
                <fieldset class="name mb-24">
                    <div class="body-title mb-10" style="margin-top: 22px">Link</div>
                    <input class="flex-grow" type="text" placeholder="Link" name="link[${index}]" tabindex="0" style="margin-bottom: 6px">
                </fieldset>
                <button type="button" class="tf-button remove-btn" onclick="removeFieldset(this)">Remove</button>
                <button type="button" class="tf-button add-subfield-btn" style="margin-top:5px;" onclick="addSubField(this, ${index})">Add Sub Field</button>
                <div class="subfield-container"></div>
            </div>`;
            $('#fieldsets-container').append(fieldsetHTML);
        }

        function removeFieldset(button) {
            $(button).closest('.fieldset-container').remove();
        }

        function addSubField(button, index) {
            let subIndex = $(button).siblings('.subfield-container').children().length;
            let subFieldHTML = `
            <div class="subfield fieldset-container" style="margin-left: 40px; margin-top: 10px;">
                <fieldset class="name mb-24">
                    <div class="body-title mb-10">Sub Name</div>
                    <input class="flex-grow" type="text" placeholder="Sub Name" name="sub_name[${index}][]" tabindex="0" style="margin-bottom: 6px">
                </fieldset>
                <fieldset class="name mb-24">
                    <div class="body-title mb-10" style="margin-top: 22px">Sub Link</div>
                    <input class="flex-grow" type="text" placeholder="Sub Link" name="sub_link[${index}][]" tabindex="0" style="margin-bottom: 6px">
                </fieldset>
                <button type="button" class="tf-button remove-btn" onclick="removeFieldset(this)">Remove</button>
            </div>`;
            $(button).siblings('.subfield-container').append(subFieldHTML);
        }
    </script>
@endsection
