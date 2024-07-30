{{-- @props(['notifications']) --}}

@if($notifications->isNotEmpty())
    <ul>
        @foreach($notifications as $notification)
            <li>
                <div class="noti-item w-full wg-user active" id="notification_div_{{ $notification->id }}" >
                    <input type="hidden" name="id" id="notification_id" value="{{ $notification->id }}"  >
                    <div class="flex-grow">
                        <div class="flex items-center justify-between">
                            <a href="#" class="body-title" style="@if ($notification->is_read == false) color: red @else color:green @endif" id="notification_link_{{ $notification->id }}">
                                {{ $notification->name }}
                            </a>
                            <div class="time">{{ $notification->created_at->timezone('Asia/Karachi')->format('h:i A') }}</div>
                        </div>
                        <div class="text-tiny">{{ $notification->detail }}</div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button class="mark-as-read" id="noti" data-notification-id="{{ $notification->id }}">
                                @if ($notification->is_read == true) Read @else Mark as Read @endif
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p>No unread notifications.</p>
@endif
