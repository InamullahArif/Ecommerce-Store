
@if (isset($user))
<li class="user-item gap14" id="row-{{$user['id']}}">
    <div class="image">
        <img src="images/avatar/user-6.png" alt="">
    </div>
    <div class="flex items-center justify-between gap20 flex-grow">
        <div style="max-width: 195px">
            {{-- @php
            if ($user['image_id'] != null) {
                $imageId = $user['image_id'];
                $image = App\Models\Image::find($imageId);
                if ($image) {
                    // $img = $image;
                    $imgUrl = asset('user_images/' . $image->name);
                } else {
                    $imgUrl = null;
                }
            } else {
                $imgUrl = null;
            }
        @endphp --}}
            {{-- <a href="#" class="body-title-2">{{$img->name ?? '--'}}</a> --}}
            @if ($user->image)
            <div class="image">
                <img src="{{ $user->image->name ?? '' }}"  class="body-title-2" style="border-radius: 10%;">
            </div>
                @else
                <div class="text-tiny mt-3">{{  '--' }}</div>
            @endif
            <div class="text-tiny mt-3">{{$user['name'] ?? '--'}}</div>
        </div>
       
        <div class="body-text">{{$user['email'] ?? '--'}}</div>
        <div class="body-text">{{$user['phone_number'] ?? '--'}}</div>
        <div class="list-icon-function">
            <div class="item eye">
                <a href="{{ route('users.index',$user['id']) }}">
                <i class="icon-eye"></i>
                </a>

            </div>
            <div class="item edit">
                <a href="{{ route('users.edit',$user['id']) }}">
                <i class="icon-edit-3"></i>
                </a>
            </div>
            {{-- <div class="item trash">
                <a href="{{ route('deleteUser',$user['id']) }}">
                <i class="icon-trash-2"></i>
                </a>
            </div> --}}
            <div class="item trash">
                <a href="#" class="delete-user del" data-user-id="{{ $user['id'] }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
            
        </div>
    </div>
</li>
@else
<div class="body-text" style="color: red">No record found</div>
@endif