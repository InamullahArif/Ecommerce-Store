@extends('dashboard.welcome')
@section('content')
    <div class="section-content-right">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                        <h3>All Comments</h3>
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
                                    <div class="text-tiny">Comments</div>
                                </a>
                            </li>
                            <li>
                                <i class="icon-chevron-right"></i>
                            </li>
                            <li>
                                <div class="text-tiny">All Comments</div>
                            </li>
                        </ul>
                    </div>
                    <div class="wg-box">
                        <div class="flex items-center justify-between gap10 flex-wrap">
                            <div class="wg-filter flex-grow">
                                <form class="form-search">
                                    <fieldset class="name">
                                        <input type="search" data-table="commentTable" id="source_search"
                                            oninput="searchResource()" placeholder="Search comment here..."
                                            class="" name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="wg-table table-all-user">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title" style="padding-left:25%">Comment</div>
                                </li>
                                {{-- <li>
                                    <div class="body-title">Username</div>
                                </li> --}}
                                {{-- <li>
                                    <div class="body-title">email</div>
                                </li> --}}
                                <li>
                                    <div class="body-title">Status</div>
                                </li>
                                <li>
                                    <div class="body-title">Created At</div>
                                </li>
                                <li>
                                    <div class="body-title">Action</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column" id="commentTable">
                                {{-- {{dd($comments->get())}} --}}
                                @if ($comments->count() > 0)
                                    @foreach ($comments as $comment)
                                        <li class="user-item gap14" id="row-{{ $comment['id'] }}">
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                <div style="max-width: 190px">
                                                    {{-- <div class="image">
                                                        <img src="{{ $blog->image->name ?? '' }}" class="body-title-2"
                                                            style="border-radius: 10%;">
                                                    </div> --}}
                                                    <div class="body-text" style="padding-left:10px;">{{ strlen($comment['content']) > 120 ? substr($comment['content'], 0, 120) . '...' : $comment['content'] ?? '--' }}</div>
                                                </div>
                                                {{-- {{dd($blog['created_by'])}} --}}
                                                {{-- <div class="body-text" style="padding-left:-50%;">{{ $comment['username'] ?? '--' }}</div> --}}
                                                {{-- <div class="body-text">  {{ $comment['email'] }}</div> --}}
                                                {{-- <div class="body-text">{{ $comment['status'] ?? '--' }}</div> --}}
                                                {{-- <div class="body-text">
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" name="status" data-comment-id="{{$comment['slug']}}" value="active" {{ $comment['status'] == 1 ? 'checked' : '' }}>
                                                        <span class="toggle-slider"></span>
                                                    </label>
                                                </div>
                                                 --}}
                                                 <div class="body-text" style="padding-left: 75px">
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" name="status" data-comment-id="{{$comment['slug']}}" value="active" {{ $comment['status'] == 1 ? 'checked' : '' }}>
                                                        <span class="toggle-slider"></span>
                                                    </label>
                                                </div>
                                                
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
                                        
                                    @endforeach
                                @else
                                    <div style="color: red; font-size: 15px; margin-top:10px;text-align: center;">No comment found</div>
                                @endif
                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing {{ $comments->count() }} entries</div>
                            <ul class="wg-pagination">
                                <li class="{{ $comments->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $comments->previousPageUrl() }}">
                                        <i class="icon-chevron-left"></i>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $comments->lastPage(); $i++)
                                    <li class="{{ $comments->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $comments->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="{{ $comments->currentPage() == $comments->lastPage() ? 'disabled' : '' }}">
                                    <a href="{{ $comments->nextPageUrl() }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.toggle-switch input[type="checkbox"]').change(function() {
            var commentId = $(this).data('comment-id');
            var status = $(this).prop('checked') ? 'active' : 'inactive';
            console.log(commentId,status);
            updateCommentStatus(commentId, status);
        });
    });

    function updateCommentStatus(commentId, status) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    $.ajax({
        type: "POST",
        url: "/comment/update-status",
        data: {
            comment_id: commentId,
            status: status
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Comment status has been updated.',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'swal-button-size'
                    },
                    willClose: () => {}
                });
            } else {
                Swal.fire(
                    'Error!',
                    'Failed to update comment status.',
                    'error'
                );
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating status:', error);
        }
    });
}

</script>

<script>
    function searchResource() {
    var search = document.getElementById("source_search");
    var search_by_name = document.getElementById("source_search").value;
    table = search.getAttribute("data-table");
    var url = window.location.href.split('?')[0];
    console.log(url);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // console.log('url:',url,'search_by_name"',search_by_name,'table:',table);
    $.ajax({
        url: url,
        type: "get",
        dataType: "JSON",
        data: {
            search_by_name: search_by_name,
            // department_id: department_id,
        },
        success: function(response) {
            console.log(response.data);
            // $("#" + table + " tbody tr").remove();
            // $("#" + table + " tbody").append(response.data);
            // $(".paginationLinks").html(response.pagination);
            $("#" + table).empty();
            // Append the new data
            $("#" + table).append(response.data);
        },
        error: function(response) {
            // debugger;
        },
    });
}
</script>
<style>
   .toggle-switch {
    position: relative;
    display: inline-block;
    width: 40px;  /* Adjusted width */
    height: 20px;  /* Adjusted height */
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;  /* Adjusted to match height */
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 16px;  /* Adjusted height */
    width: 16px;  /* Adjusted width */
    left: 2px;  /* Adjusted positioning */
    bottom: 2px;  /* Adjusted positioning */
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: #4CAF50;
}

input:checked + .toggle-slider:before {
    transform: translateX(20px);  /* Adjusted for smaller width */
}

/* Optional: Add focus styles for accessibility */
input:focus + .toggle-slider {
    box-shadow: 0 0 1px #4CAF50;
}


</style>