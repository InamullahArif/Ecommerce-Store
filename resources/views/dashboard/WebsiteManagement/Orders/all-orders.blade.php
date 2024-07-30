@extends('dashboard.welcome')
@section('content')
{{-- {{dd($orders)}} --}}
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>All Orders</h3>
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
                                    <div class="text-tiny">Order</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">All Orders</div>
                            </li>
                        </ul>
                    </div>
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <form class="form-search">
                                    <fieldset class="name">
                                        <input type="search" data-table="orderTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search order here..."
                                            class="" name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            {{-- @can('create_users')
                            <a class="tf-button style-1 w208" href="{{ route('create-blog') }}"><i
                                    class="icon-plus"></i>Add Blog</a>
                            @endcan --}}
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">Order ID</div>
                                </li>
                                <li>
                                    <div class="body-title">User Email</div>
                                </li>
                                <li>
                                    <div class="body-title">Contact No.</div>
                                </li>
                                <li>
                                    <div class="body-title">Shipping Address</div>
                                </li>
                                <li>
                                    <div class="body-title">Price</div>
                                </li>
                                <li>
                                    <div class="body-title">Placed At</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="orderTable">
                                {{-- {{dd($blogs)}} --}}
                                @if (!$orders->isEmpty())
                                    @foreach ($orders as $order)
                                        <li class="user-item gap14" id="row-{{ $order->id }}">
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                {{-- <div style="max-width: 145px">
                                                    <div class="image">
                                                        <img src="{{ $blog->image->name ?? '' }}" class="body-title-2"
                                                            style="border-radius: 10%;">
                                                    </div>
                                                    <div class="body-text" style="padding-left:10px;">{{ strlen($blog['title']) > 20 ? substr($blog['title'], 0, 20) . '...' : $blog['title'] ?? '--' }}</div>
                                                </div> --}}
                                                {{-- {{dd($blog['created_by'])}} --}}
                                                @php
                                                    $data = $order->data;
                                                    $dat = json_decode($data,true);
                                                    $data = json_decode($dat,true);
                                                    $data = $data[0];
                                                    // dd($data,$order);
                                                @endphp
                                                <div class="body-text" style="width:170px;padding-left:40px;">{{ $order->order_id ?? '--' }}</div>
                                                <div class="body-text" style="padding-left:-500px;">{{ $order->email ?? '--' }}</div>
                                                <div class="body-text">{{ $order->phone_no ?? '--' }}</div>
                                                <div class="body-text">{{ $order->shipping_address ?? '--' }}</div>
                                                <div class="body-text">{{ '$'.$order->total_price ?? '--' }}</div>
                                                <div class="body-text"> {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Karachi')->format('jS F, Y g:ia') }}</div>
                                                <div class="list-icon-function">
                                                    @can('view_users')
                                                    <div class="item eye">
                                                        <a href="{{ route('view-order', $order->id ?? '--') }}">
                                                            <i class="icon-eye"></i>
                                                        </a>

                                                    </div>
                                                    @endcan
                                                    {{-- @can('edit_users')
                                                    <div class="item edit">
                                                        <a href="{{ route('edit-blog', $blog['slug'] ?? '--') }}">
                                                            <i class="icon-edit-3"></i>
                                                        </a>
                                                    </div>
                                                    @endcan --}}
                                                    @can('delete_users')
                                                    <div class="item trash">
                                                        <a class="delete-user del_order"
                                                            data-order-id="{{ $order->id }}">
                                                            <i class="icon-trash-2"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </li>
                                        
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px;text-align: center;">No order found</div>
                                @endif
                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $orders->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $orders->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $orders->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                    <li class="{{ $orders->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $orders->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="{{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $orders->nextPageUrl() }}">
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
