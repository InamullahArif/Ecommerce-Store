@if (isset($category))
<li class="roles-item" id="row-{{$category->id}}">
    {{-- <div class="body-text">{{$i++}}</div> --}}
    <div class="body-text">{{$category->name ?? '--'}}</div>
    <div class="body-text">{{$category->description ?? '--'}}</div>
    <div class="list-icon-function">
        @can('edit_role')
        <div class="item edit">
            <a  onclick="openEditCategoryModal('{{ $category->id }}')" data-category-id="{{ $category->id }}">
            <i class="icon-edit-3"></i>
            </a>
        </div>
        @endcan
        @can('delete_role')
        <div class="item trash">
            <a href="#" class="delete-user del_categories" data-category-id="{{ $category->id }}">
                <i class="icon-trash-2"></i>
            </a>
        </div>
        @endcan
    </div>
</li>
@endif