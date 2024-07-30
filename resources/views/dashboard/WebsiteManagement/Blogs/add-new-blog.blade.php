@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>{!! __(!empty($blogs) ? 'Update Blog' : 'Add New Blog') !!}</h3>
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
                                <div class="text-tiny">{!! __(!empty($blogs) ? 'Update Blog' : 'Add New Blog') !!}</div>
                            </li>
                        </ul>
                    </div>
                    <form class="form-add-new-user form-style-2" id="addBlog" name="addUser" method="POST"
                        enctype="multipart/form-data"
                        action="{{ !empty($blogs['slug']) ? route('update-blog', $blogs['slug']) : route('store-blog') }}">
                        @csrf
                        {{-- {{dd($blogs['slug'])}} --}}
                        <div class="wg-box">
                            <div class="right flex-grow">
                                <fieldset class="name mb-24">
                                    <div class="body-title mb-10">Blog Title</div>
                                    <input type="hidden" name="blog_id" id="blog_id" @if(isset($blogs['slug'])) value={{$blogs['slug']}} @endif>
                                    <input class="flex-grow" type="text" placeholder="Title"
                                        @if (isset($blogs['title'])) value="{{ $blogs['title'] }}" 
                                                @else value="{{ old('title') }}" @endif
                                        name="title" tabindex="0" value="" aria-required="true"
                                        style="margin-bottom: 6px">
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
                                        style="margin-bottom: 6px">
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
                                        style="margin-bottom: 6px">
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
                                        style="margin-bottom: 6px">
                                    @error('qoute_author_name')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="description mb-24">
                                    <div class="body-title mb-10">Description</div>
                                    <textarea class="flex-grow" placeholder="Description" name="description" tabindex="0" aria-required="true" style="margin-bottom: 6px">
                                        @if (isset($blogs['description'])){{ $blogs['description'] }}@else{{ old('description') }}@endif</textarea>
                                    @error('description')
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="name">
                                    <div class="body-title mb-10">Category</div>
                                    <select class="flex-grow" name="category_id" tabindex="0" aria-required="true" required>
                                        <option value="" disabled>Select a category</option>
                                        @foreach ($cat as $c)
                                            <option value="{{ $c->id }}"
                                                @if (isset($category) && ($category->name ? $category->name === $c->name : false)) selected @endif>
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                @enderror
                                </fieldset>
                                
                                <fieldset class="image mb-24" style="margin-top: 10px">
                                    <div class="body-title mb-10">Blog Image</div>
                                    <input type="file" name="image" accept="image/*" tabindex="0"
                                        aria-required="true">
                                    @error('image')
                                        <br></br>
                                        <span style="color: red; font-size: 15px; margin-top:10px">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                {{-- {{dd($blogs->image->name)}} --}}
                                @if (isset($blogs->image->name))
                                    <img src="{{ asset($blogs ->image->name ?? '') }}" alt="Blog Image"
                                        style="max-width: 100px; margin-top: 10px; border-radius:10%;margin-bottom:6px;">
                                @else
                                    <input type="hidden" name="image_url" value="{{ asset('blog_images/blog.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="bot">
                            <button class="tf-button w180" type="submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
