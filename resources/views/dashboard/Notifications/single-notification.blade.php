
@if (isset($notification))
<li class="user-item gap14" id="row-{{ $notification['id'] }}">
    <div class="flex items-center justify-between  flex-grow">
        <div style="max-width: 160px">
            <div class="body-text mt-3" style="@if ($notification->is_read == false) color: red @else color:green @endif" id="notification_{{ $notification->id }}">{{ $notification['name'] ?? '--' }}</div>
        </div>

        <div class="body-text">{{ $notification['detail'] ?? '--' }}</div>
        <div class="body-text" style="padding-left:25px;">{{ $notification['created_at'] ?? '--' }}</div>
        <div style="display: flex; font-size:15px; padding-left:50px">
            <button class="mark-as-read"  data-notification-id="{{ $notification->id }}">@if ($notification->is_read == true) Read @else Mark as Read @endif</button>
        </div>     
        <div class="list-icon-function">
            <div class="item trash">
                <a href="#" class="delete-user del"
                    data-notification-id="{{ $notification['id'] }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
        </div>
    </div>
</li>
@else
<div class="body-text" style="color: red">No record found</div>
@endif