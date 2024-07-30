@if(isset($color))
<li class="roles-item" id="row-{{$color->slug}}">
    <div class="body-text">{{$color->name ?? '--'}}</div>
    <div class="list-icon-function">
        @can('edit_role')
        <div class="item edit">
            {{-- {{dd($color)}} --}}
            <a  onclick="openEditColorModal('{{ $color->slug }}')" data-color-id="{{ $color->slug }}">
            <i class="icon-edit-3"></i>
            </a>
        </div>
        @endcan
        @can('delete_role')
        <div class="item trash">
            <a href="#" class="delete-user del_colors" data-color-id="{{ $color->slug }}">
                <i class="icon-trash-2"></i>
            </a>
        </div>
        @endcan
    </div>
</li>
@else
    <div style="color: red; font-size: 15px; margin-top: 10px; text-align: center;">No color found</div>
@endif