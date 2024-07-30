@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>View Blog</h3>
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
                                    <div class="text-tiny">Blog</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">View Blog</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="viewBlog" name="viewBlog" >
                        @csrf
                        <div class="wg-box">
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Blog Title</div>
                                    <input class="flex-grow" type="text" placeholder="Username"
                                        @if (isset($blogs['title'])) value="{{ $blogs['title'] }}" 
                                                @else value="{{ old('title') }}" @endif
                                        name="title" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly>
                                    @error('title')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Author Name</div>
                                    <input class="flex-grow" type="text" placeholder="Author Name"
                                        @if (isset($blogs['author_name'])) value="{{ $blogs['author_name'] }}" 
                                                @else value="{{ old('author_name') }}" @endif
                                        name="author_name" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly>
                                    @error('author_name')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Quote</div>
                                    <input class="flex-grow" type="text" placeholder="Write a qoute related to your blog"
                                        @if (isset($blogs['qoute'])) value="{{ $blogs['qoute'] }}" 
                                                @else value="{{ old('qoute') }}" @endif
                                        name="qoute" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px" readonly>
                                    @error('qoute')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Qoute Author</div>
                                    <input class="flex-grow" type="text" placeholder="Author Name"
                                        @if (isset($blogs['qoute_author_name'])) value="{{ $blogs['qoute_author_name'] }}" 
                                                @else value="{{ old('qoute_author_name') }}" @endif
                                        name="qoute_author_name" tabindex="0" value="" aria-required="true"
                                    style="margin-bottom: 6px" readonly>
                                    @error('qoute_author_name')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>


                                {{-- {{dd($blogs['description'])}} --}}
                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Description</div>
                                    <textarea class="flex-grow" placeholder="Description" name="description" tabindex="0" aria-required="true" style="margin-bottom: 6px" readonly>
                                        @if (isset($blogs['description']))
                                            {{ $blogs['description'] }}
                                        @else
                                            {{ old('description') }}
                                        @endif
                                    </textarea>
                                    @error('description')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                
                                
                                {{-- {{dd($blogs)}} --}}
                                <fieldset class="name">
                                    <div class="body-title mb-10">Category</div>
                                    <select class="flex-grow" name="category_id" tabindex="0" aria-required="true" required="" disabled>
                                        <option value="" disabled>Select a category</option>
                                            <option value="{{ $blogs->id }}" 
                                                @if (isset($blogs['category']) && $blogs->category_id == $blogs['category_id']) selected @endif>
                                                {{ $blogs['category']->name ?? '--'}}
                                            </option>
                                    </select>
                                    <input type="hidden" name="category_id" value="{{ $blogs->category_id }}">
                                </fieldset>
                                <fieldset class="image mb-24" style="margin-top: 10px">
                                    <div class="body-title mb-10">Blog Image</div>
                                    {{-- <input type="file" name="image" accept="image/*" tabindex="0"
                                        aria-required="true"> --}}
                                    @error('image')
                                        <br></br>
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                @if (isset($blogs ->image->name))
                                    <img src="{{ asset($blogs ->image->name ?? '') }}" alt="Blog Image"
                                        style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                @else
                                    <input type="hidden" name="image_url" value="{{ asset('blog_images/blog.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="bot">
                            <a class="tf-button w180" href="{{route('show-blog')}}">Back
                            {{-- <button class="tf-button w180" type="submit"> Back</button> --}}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
