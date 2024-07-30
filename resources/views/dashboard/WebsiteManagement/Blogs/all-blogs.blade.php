@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>All Blogs</h3>
                        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                            <li>
                                <a href="/dashboardOne">
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
                                <div class="text-tiny">All Blogs</div>
                            </li>
                        </ul>
                    </div>
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <form class="form-search">
                                    <fieldset class="name">
                                        <input type="search" data-table="blogTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search blog here..."
                                            class="" name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            @can('create_users')
                            <a class="tf-button style-1 w208" href="{{ route('create-blog') }}"><i
                                    class="icon-plus"></i>Add Blog</a>
                            @endcan
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">Blog Title</div>
                                </li>
                                <li>
                                    <div class="body-title">Author Name</div>
                                </li>
                                <li>
                                    <div class="body-title">Description</div>
                                </li>
                                <li>
                                    <div class="body-title">Created By</div>
                                </li>
                                <li>
                                    <div class="body-title">Created At</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="blogTable">
                                {{-- {{dd($blogs)}} --}}
                                @if (!$blogs->isEmpty())
                                    @foreach ($blogs as $blog)
                                        {{-- <div class="body-text">{{ $blog['title'] ?? '--' }}</div>
                                        <div class="body-text">{{ $blog['author_name'] ?? '--' }}</div>
                                        <div class="body-text">{{ $blog['description'] ?? '--' }}</div>
                                        <div class="body-text">{{ $blog['created_by'] ?? '--' }}</div>
                                        <div class="body-text">{{ $blog['created_at'] ?? '--' }}</div>
                                        <div class="list-icon-function">
                                            @can('view_users')
                                                <div class="item eye">
                                                    <a href="{{ route('users.show', $blog ['id']) }}">
                                                        <i class="icon-eye"></i>
                                                    </a>

                                                </div>
                                            @endcan
                                            @can('edit_users')
                                                <div class="item edit">
                                                    <a href="{{ route('users.edit', $blog['id']) }}">
                                                        <i class="icon-edit-3"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('delete_users')
                                                <div class="item trash">
                                                    <a href="#" class="delete-user del_user"
                                                        data-blog-id="{{ $blog['id'] }}">
                                                        <i class="icon-trash-2"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                        </div> --}}
                                        <li class="user-item gap14" id="row-{{ $blog['id'] }}">
                                            {{-- <div class="image">
                                                <img src="images/avatar/user-6.png" alt="">
                                            </div> --}}
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                <div style="max-width: 145px">
                                                    <div class="image">
                                                        <img src="{{ $blog->image->name ?? '' }}" class="body-title-2"
                                                            style="border-radius: 10%;">
                                                    </div>
                                                    <div class="body-text" style="padding-left:10px;">{{ strlen($blog['title']) > 20 ? substr($blog['title'], 0, 20) . '...' : $blog['title'] ?? '--' }}</div>
                                                </div>
                                                {{-- {{dd($blog['created_by'])}} --}}
                                                <div class="body-text" style="padding-left:-50%;">{{ $blog['author_name'] ?? '--' }}</div>
                                                <div class="body-text">  {{ strlen($blog['description']) > 25 ? substr($blog['description'], 0, 25) . '...' : $blog['description'] ?? '--' }}</div>
                                                <div class="body-text">{{ $blog['created_by'] ?? '--' }}</div>
                                                <div class="body-text"> {{ \Carbon\Carbon::parse($blog['created_at'])->setTimezone('Asia/Karachi')->format('jS F, Y g:ia') }}</div>
                                                <div class="list-icon-function">
                                                    @can('view_users')
                                                    <div class="item eye">
                                                        <a href="{{ route('view-blog', $blog['slug'] ?? '--') }}">
                                                            <i class="icon-eye"></i>
                                                        </a>

                                                    </div>
                                                    @endcan
                                                    @can('edit_users')
                                                    <div class="item edit">
                                                        <a href="{{ route('edit-blog', $blog['slug'] ?? '--') }}">
                                                            <i class="icon-edit-3"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @can('delete_users')
                                                    <div class="item trash">
                                                        <a href="{{ route('delete-blog', $blog['slug'] ?? '--') }}" class="delete-user del_blog"
                                                            data-blog-id="{{ $blog['slug'] }}">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </li>
                                        
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px;text-align: center;">No blog found</div>
                                @endif
                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $blogs->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $blogs->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $blogs->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                    <li class="{{ $blogs->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="{{ $blogs->currentPage() == $blogs->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $blogs->nextPageUrl() }}">
                                        <i class="icon-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.delete-modal')
@endsection
