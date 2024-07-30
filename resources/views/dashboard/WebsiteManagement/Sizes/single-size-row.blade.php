@if(isset($size))
<li class="roles-item" id="row-{{$size->slug}}">
    <div class="body-text">{{$size->name ?? '--'}}</div>
    <div class="list-icon-function">
        @can('edit_role')
        <div class="item edit">
            {{-- {{dd($size)}} --}}
            <a  onclick="openEditSizeModal('{{ $size->slug }}')" data-size-id="{{ $size->slug }}">
            <i class="icon-edit-3"></i>
            </a>
        </div>
        @endcan
        @can('delete_role')
        <div class="item trash">
            <a href="#" class="delete-user del_sizes" data-size-id="{{ $size->slug }}">
                <i class="icon-trash-2"></i>
            </a>
        </div>
        @endcan
    </div>
</li>
@else
    <div style="color: red; font-size: 15px; margin-top: 10px; text-align: center;">No size found</div>
@endif