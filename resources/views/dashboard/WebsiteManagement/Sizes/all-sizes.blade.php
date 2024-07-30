@extends('dashboard.welcome')
@section('content')
<div class="section-content-right">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Size List</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="/"><div class="text-tiny">Dashboard</div></a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="#"><div class="text-tiny">Sizes</div></a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Size List</div>
                        </li>
                    </ul>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search size here..." data-table="sizeTable" id="source_search" oninput="searchResource()" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        @can('create_role')
                        <a id="add-size-link" onclick="showSizeModal()" class="tf-button style-1 w208"><i class="icon-plus"></i>Add Size</a>
                        @endcan
                    </div>
                    <div class="wg-table table-all-roles">
                        <ul class="table-title flex gap20 mb-14">
                            <li class="flex-grow">
                                <div class="body-title">Name</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column" id="sizeTable">
                            @if(!$sizes->isEmpty())
                            @foreach($sizes as $size)
                            <li class="roles-item" id="row-{{$size->slug}}">
                                <div class="flex items-center justify-between gap20">
                                    <div class="body-text">{{$size->name ?? '--'}}</div>
                                    <div class="list-icon-function">
                                        @can('edit_role')
                                        <div class="item edit">
                                            {{-- {{dd($size)}} --}}
                                            <a onclick="openEditSizeModal('{{ $size->slug }}')" data-size-id="{{ $size->slug }}">
                                                <i class="icon-edit-3"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('delete_role')
                                        <div class="item trash">
                                            <a href="#" class="delete-user del_sizes" data-size-id="{{ $size->slug }}">
                                                <i class="icon-trash-2"></i>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            {{-- @else
                            <div style="color: red; font-size: 15px; margin-top: 10px; text-align: center;">No size found</div> --}}
                            @endif
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing {{ $sizes->count() }} entries</div>
                        <ul class="wg-pagination">
                            <li class="{{ ($sizes->currentPage() == 1) ? 'disabled' : '' }}">
                                <a href="{{ $sizes->previousPageUrl() }}">
                                    <i class="icon-chevron-left"></i>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $sizes->lastPage(); $i++)
                            <li class="{{ ($sizes->currentPage() == $i) ? 'active' : '' }}">
                                <a href="{{ $sizes->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor
                            <li class="{{ ($sizes->currentPage() == $sizes->lastPage()) ? 'disabled' : '' }}">
                                <a href="{{ $sizes->nextPageUrl() }}">
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
@include('dashboard.WebsiteManagement.Sizes.add-size-modal')
@endsection
