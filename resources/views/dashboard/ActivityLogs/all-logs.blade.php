@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>All Logs</h3>
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
                                    <div class="text-tiny">Activity Logs</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">All Logs</div>
                            </li>
                        </ul>
                    </div>
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <form class="form-search">
                                    <fieldset class="name">
                                        <input type="search" data-table="logTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search log here..." class=""
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            {{-- @can('create_users')
                            <a class="tf-button style-1 w208" href="{{ route('create-log') }}"><i
                                    class="icon-plus"></i>Add Blog</a>
                            @endcan --}}
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">No</div>
                                </li>
                                <li>
                                    <div class="body-title">Subject</div>
                                </li>
                                <li>
                                    <div class="body-title">Url</div>
                                </li>
                                <li>
                                    <div class="body-title">Method</div>
                                </li>
                                <li>
                                    <div class="body-title">IP</div>
                                </li>
                                <li>
                                    <div class="body-title">User Agent</div>
                                </li>
                                <li>
                                    <div class="body-title">User Id</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="logTable">
                                @if (!$logs->isEmpty())
                                    @foreach ($logs as $key => $log)
                                        {{-- {{dd($log->status)}} --}}
                                        <li class="user-item gap14" id="row-{{ $log->id }}">
                                            {{-- <div class="image">
                                                <img src="images/avatar/user-6.png" alt="">
                                            </div> --}}
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                <div style="max-width: 100px">
                                                    <div class="body-text" style="padding-left:10px;color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">{{ ++$key }}
                                                    </div>
                                                </div>
                                                {{-- {{dd($log['created_by'])}} --}}
                                                <div class="body-text"
                                                    style="color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ $log->subject ?? '--' }}</div>
                                                <div class="body-text"
                                                    style="max-width: 120px;color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ strlen($log->url) > 15 ? substr($log->url, 0, 15) . '...' : $log->url ?? '--' }}
                                                </div>
                                                <div class="body-text"
                                                    style="padding-left: 10px;color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ $log->method ?? '--' }}</div>
                                                <div class="body-text"
                                                    style="color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ $log->ip ?? '--' }}</div>
                                                <div class="body-text"
                                                    style="color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ strlen($log->agent) > 25 ? substr($log->agent, 0, 25) . '...' : $log->agent ?? '--' }}
                                                </div>
                                                <div class="body-text"
                                                    style="color: 
                                                @if ($log->status == 'success') green 
                                                @elseif($log->status == 'error') red 
                                                @else blue @endif;">
                                                    {{ $log->user_id ?? '--' }}</div>
                                                <div class="list-icon-function">
                                                    @can('view_users')
                                                        <div class="item eye">
                                                            <a href="{{ route('view-log', $log->id ?? '--') }}"
                                                                style="color: 
                                                            @if ($log->status == 'success') green 
                                                            @elseif($log->status == 'error') red 
                                                            @else blue @endif;">
                                                                <i class="icon-eye"></i>
                                                            </a>

                                                        </div>
                                                    @endcan
                                                    @can('delete_users')
                                                        <div class="item trash">
                                                            <a href="{{ route('delete-log', $log->id ?? '--') }}"
                                                                class="delete-user del_log" data-log-id="{{ $log->id }}"
                                                                style="color: 
                                                            @if ($log->status == 'success') green 
                                                            @elseif($log->status == 'error') red 
                                                            @else blue @endif;">
                                                                <i class="icon-trash-2"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px;text-align: center;">No log
                                        found</div>
                                @endif
                            </ul>
                        </div>
                        {{-- <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $logs->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $logs->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $logs->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $logs->lastPage(); $i++)
                                    <li class="{{ $logs->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $logs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="{{ $logs->currentPage() == $logs->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $logs->nextPageUrl() }}">
                                        <i class="icon-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('dashboard.delete-modal') --}}
@endsection
