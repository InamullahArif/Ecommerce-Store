<li class="user-item gap14" id="row-{{ $log['id'] }}">
    {{-- <div class="image">
        <img src="images/avatar/user-6.png" alt="">
    </div> --}}
    <div class="flex items-center justify-between gap20 flex-grow">
        <div style="max-width: 100px">
            <div class="body-text" style="padding-left:10px;">{{ $i }}</div>
        </div>
        {{-- {{dd($log['created_by'])}} --}}
        <div class="body-text" >{{ $log->subject ?? '--' }}</div>
        <div class="body-text" style="max-width: 120px">  {{ strlen($log->url) > 15 ? substr($log->url, 0, 15) . '...' : $log->url ?? '--' }}</div>
        <div class="body-text"  style="padding-left: 10px">{{ $log->method ?? '--' }}</div>
        <div class="body-text"> {{ $log->ip ?? '--' }}</div>
        <div class="body-text"> {{ strlen($log->agent) > 25 ? substr($log->agent, 0, 25) . '...' : $log->agent ?? '--'  }}</div>
        <div class="body-text"> {{ $log->user_id  ?? '--' }}</div>
        <div class="list-icon-function">
            @can('view_users')
            <div class="item eye">
                <a href="{{ route('view-log', $log->id ?? '--') }}">
                    <i class="icon-eye"></i>
                </a>

            </div>
            @endcan
            @can('delete_users')
            <div class="item trash">
                <a href="{{ route('delete-log', $log->id ?? '--') }}" class="delete-user del_log"
                    data-log-id="{{ $log->id }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
            @endcan
        </div>
    </div>
</li>