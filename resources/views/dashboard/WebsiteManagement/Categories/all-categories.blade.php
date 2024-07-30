@extends('dashboard.welcome')
@section('content')
                <div class="section-content-right">
                    <div class="main-content">
                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Category List</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="/"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">Categories</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Category List</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search category here..." data-table="categoryTable" id="source_search" oninput="searchResource()" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        @can('create_role')
                                            <a id="add-category-link" onclick="showCategoryModal()" class="tf-button style-1 w208"><i class="icon-plus"></i>Add category</a>
                                        @endcan
                                    </div>
                                    <div class="wg-table table-all-roles">
                                        <ul class="table-title flex gap20 mb-14">
                                            {{-- <li>
                                                <div class="body-title">No</div>
                                            </li>     --}}
                                            <li>
                                                <div class="body-title">Name</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Description</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                       
                                        <ul class="flex flex-column" id="categoryTable">
                                            @if(!$categories->isempty())
                                            {{-- {{dd($categories[0]->id)}} --}}
                                            @foreach($categories as $category)
                                            <li class="roles-item" id="row-{{$category->id}}">
                                                <div class="body-text">{{$category->name ?? '--'}}</div>
                                                <div class="body-text">
                                                    {{ strlen($category->description) > 80 ? substr($category->description, 0, 80) . '...' : $category->description ?? '--' }}
                                                </div>
                                                <div class="list-icon-function">
                                                    @can('edit_role')
                                                    <div class="item edit">
                                                        <a  onclick="openEditCategoryModal('{{ $category->id }}')" data-category-id="{{ $category->id }}">
                                                        <i class="icon-edit-3"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @can('delete_role')
                                                    <div class="item trash">
                                                        <a href="#" class="delete-user del_categories" data-category-id="{{ $category->id }}">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </li>
                                            @endforeach
                                            @else
                                                <div style="color: red; font-size: 15px; margin-top: 10px; text-align: center;">No category found</div>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <div class="text-tiny">Showing {{ $categories->count() }} entries</div>
                                        <ul class="wg-pagination">
                                            <li class="{{ ($categories->currentPage() == 1) ? 'disabled' : '' }}">
                                                <a href="{{ $categories->previousPageUrl() }}">
                                                    <i class="icon-chevron-left"></i>
                                                </a>
                                            </li>
                                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                                <li class="{{ ($categories->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{ $categories->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="{{ ($categories->currentPage() == $categories->lastPage()) ? 'disabled' : '' }}">
                                                <a href="{{ $categories->nextPageUrl() }}">
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
                @include('dashboard.WebsiteManagement.Categories.add-category-modal')
@endsection