{{-- @php
    $i = 1;
    @endphp --}}
@if (isset($role))
<ul class="flex flex-column" id="roleTable">
    {{-- @if(isset($roles)) --}}
    {{-- @php
    $i = 1;
    @endphp --}}
    <li class="roles-item" id="row-{{$role['id']}}">
        <div class="body-text">{{$role['i']}}</div>
        <div class="body-text">{{$role->name ?? '--'}}</div>
        <div class="body-text">{{$role['created_at'] ?? '--'}}</div>
        {{-- <div class="body-text">{{$user[''] ?? '--'}}</div> --}}
        <div class="list-icon-function">
            <div class="item edit">
                <a href="{{ route('roles.edit',$role['id']) }}">
                <i class="icon-edit-3"></i>
                </a>
            </div>
            <div class="item trash">
                <a href="#" class="delete-user del-role" data-role-id="{{ $role['id'] }}">
                    <i class="icon-trash-2"></i>
                </a>
            </div>
        </div>
    </li>
    {{-- @endif --}}
</ul>
@else
<div class="body-text" style="color: red">No record found</div>
@endif