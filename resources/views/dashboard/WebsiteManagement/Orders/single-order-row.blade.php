@if(isset($order))
<li class="user-item gap14" id="row-{{ $order->id }}">
    <div class="flex items-center justify-between gap20 flex-grow">
        @php
            $data = $order->data;
            $dat = json_decode($data,true);
            $data = json_decode($dat,true);
            $data = $data[0];
        @endphp
        <div class="body-text" style="width:170px;padding-left:40px;">{{ $order->order_id ?? '--' }}</div>
        <div class="body-text" style="padding-left:-500px;">{{ $order->email ?? '--' }}</div>
        <div class="body-text">{{ $order->phone_no ?? '--' }}</div>
        <div class="body-text">{{ $order->shipping_address ?? '--' }}</div>
        <div class="body-text">{{ $order->total_price ?? '--' }}</div>
        <div class="body-text"> {{ \Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Karachi')->format('jS F, Y g:ia') }}</div>
        <div class="list-icon-function">
            @can('view_users')
            <div class="item eye">
                <a href="{{ route('view-order', $order->id ?? '--') }}">
                    <i class="icon-eye"></i>
                </a>

            </div>
            @endcan
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
@else
<div style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <span style="color: red; font-size: 15px; margin-top: 10px;">No order found</span>
</div>

@endif