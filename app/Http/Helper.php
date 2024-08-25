<?php

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;

function convertToSar($amount): float|int
{
    return ($amount / 100);
}

function convertToHallal($amount): float|int
{
    return ($amount * 100);
}



/*
 * Check Role & Permission
 */

function checkRolesAndPermission($role): bool
{
    if (backpack_auth()->user()->hasRole($role)) {
        return true;
    }

    return false;

}
