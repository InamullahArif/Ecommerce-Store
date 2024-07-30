@if(isset($comment))
<li class="user-item gap14" id="row-{{ $comment['id'] }}">
    <div class="flex items-center justify-between gap20 flex-grow">
        <div style="max-width: 145px">
            {{-- <div class="image">
                <img src="{{ $blog->image->name ?? '' }}" class="body-title-2"
                    style="border-radius: 10%;">
            </div> --}}
            <div class="body-text" style="padding-left:10px;">{{ strlen($comment['content']) > 20 ? substr($comment['content'], 0, 20) . '...' : $comment['content'] ?? '--' }}</div>
        </div>
        {{-- {{dd($blog['created_by'])}} --}}
        <div class="body-text" style="padding-left:-50%;">{{ $comment['username'] ?? '--' }}</div>
        <div class="body-text">  {{ $comment['email'] }}</div>
        <div class="body-text">{{ $comment['status'] ?? '--' }}</div>
        <div class="body-text"> {{ \Carbon\Carbon::parse($comment['created_at'])->setTimezone('Asia/Karachi')->format('jS F, Y g:ia') }}</div>
        <div class="list-icon-function">
            @can('view_users')
            <div class="item eye">
                <a href="{{ route('view-comment', $comment['slug'] ?? '--') }}">
                    <i class="icon-eye"></i>
                </a>

            </div>
            @endcan
        </div>
    </div>
</li>
@endif