<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

abstract class GeneralHelper
{
    public static function getPermissions() {

        $permissions=DB::table('permissions')->get();
        return $permissions; 
        }
}
