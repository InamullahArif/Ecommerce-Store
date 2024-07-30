@if(isset($blog))
<li class="user-item gap14" id="row-{{ $blog['id'] }}">
    {{-- <div class="image">
        <img src="images/avatar/user-6.png" alt="">
    </div> --}}
    <div class="flex items-center justify-between gap20 flex-grow">
        <div style="max-width: 145px">
            <div class="image">
                <img src="{{ $blog->image->name ?? '' }}" class="body-title-2"
                    style="border-radius: 10%;">
            </div>
            <div class="body-text" style="padding-left:10px;">{{ strlen($blog['title']) > 20 ? substr($blog['title'], 0, 20) . '...' : $blog['title'] ?? '--' }}</div>
        </div>
        {{-- {{dd($blog['created_by'])}} --}}
        <div class="body-text" style="padding-left:-50%;">{{ $blog['author_name'] ?? '--' }}</div>
        <div class="body-text">  {{ strlen($blog['description']) > 25 ? substr($blog['description'], 0, 25) . '...' : $blog['description'] ?? '--' }}</div>
        <div class="body-text">{{ $blog['created_by'] ?? '--' }}</div>
        <div class="body-text">{{ $blog['created_at'] ?? '--' }}</div>
        <div class="list-icon-function">
            @can('view_users')
            <div class="item eye">
                <a href="{{ route('view-blog', $blog['slug'] ?? '--') }}">
                    <i class="icon-eye"></i>
                </a>

            </div>
            @endcan
            @can('edit_users')
            <div class="item edit">
                <a href="{{ route('edit-blog', $blog['slug'] ?? '--') }}">
                    <i class="icon-edit-3"></i>
                </a>
            </div>
            @endcan
            @can('delete_users')
            <div class="item trash">
                <a href="{{ route('delete-blog', $blog['slug'] ?? '--') }}" class="delete-user del_blog"
                    data-blog-id="{{ $blog['slug'] }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
            @endcan
        </div>
    </div>
</li>
@endif