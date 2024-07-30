@extends('dashboard.welcome')
@section('content')
<div class="section-content-right">
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Color List</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="/"><div class="text-tiny">Dashboard</div></a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="#"><div class="text-tiny">Colors</div></a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Color List</div>
                        </li>
                    </ul>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search color here..." data-table="colorTable" id="source_search" oninput="searchResource()" class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        @can('create_role')
                        <a id="add-color-link" onclick="showColorModal()" class="tf-button style-1 w208"><i class="icon-plus"></i>Add Color</a>
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
                        <ul class="flex flex-column" id="colorTable">
                            @if(!$colors->isEmpty())
                            @foreach($colors as $color)
                            <li class="roles-item" id="row-{{$color->slug}}">
                                <div class="flex items-center justify-between gap20">
                                    <div class="body-text">{{$color->name ?? '--'}}</div>
                                    <div class="list-icon-function">
                                        @can('edit_role')
                                        <div class="item edit">
                                            {{-- {{dd($color)}} --}}
                                            <a onclick="openEditColorModal('{{ $color->slug }}')" data-color-id="{{ $color->slug }}">
                                                <i class="icon-edit-3"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('delete_role')
                                        <div class="item trash">
                                            <a href="#" class="delete-user del_colors" data-color-id="{{ $color->slug }}">
                                                <i class="icon-trash-2"></i>
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @else
                            <div style="color: red; font-size: 15px; margin-top: 10px; text-align: center;">No color found</div>
                            @endif
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing {{ $colors->count() }} entries</div>
                        <ul class="wg-pagination">
                            <li class="{{ ($colors->currentPage() == 1) ? 'disabled' : '' }}">
                                <a href="{{ $colors->previousPageUrl() }}">
                                    <i class="icon-chevron-left"></i>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $colors->lastPage(); $i++)
                            <li class="{{ ($colors->currentPage() == $i) ? 'active' : '' }}">
                                <a href="{{ $colors->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor
                            <li class="{{ ($colors->currentPage() == $colors->lastPage()) ? 'disabled' : '' }}">
                                <a href="{{ $colors->nextPageUrl() }}">
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
@include('dashboard.WebsiteManagement.Colors.add-color-modal')
@endsection
