<?php

namespace App\Helpers;

class AccessRightsHelper
{
    public static function checkPermission($permissionName)
    {
        $accessRights = session('accessRights', []);
        return isset($accessRights[$permissionName]) && $accessRights[$permissionName] == 1 ? 'inline' : 'none';
    }
}
