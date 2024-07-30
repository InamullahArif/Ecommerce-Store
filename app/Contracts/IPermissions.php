<?php

namespace App\Contracts;

interface IPermissions
{
    public const VIEW_USERS = 'view_users';
    public const CREATE_USERS = 'create_users';
    public const EDIT_USERS = 'edit_users';
    public const DELETE_USERS = 'delete_users';
    public const PROFILE_UPDATE = 'profile_update';
    public const PROFILE_VIEW = 'profile_view';
}
