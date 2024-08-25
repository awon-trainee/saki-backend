<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    protected string $guardName;

    const DASHBOARD = 'dashboard';
    const ROLES = 'roles';
    const TRANSFER = 'transfer';
    const COUNTRIES = 'countries';
    const CATEGORIES = 'categories';
    const MARKETS = 'market';
    const ITEMS = 'items';
    const USERS = 'users';
    const BENEFICIARIES = 'beneficiaries';


    const ADMIN_PERMISSIONS = [
        self::DASHBOARD,
        self::ROLES,
        self::TRANSFER,
        self::COUNTRIES,
        self::CATEGORIES,
        self::MARKETS,
        self::ITEMS,
        self::USERS,
        self::BENEFICIARIES,
    ];


    const CHARITY_PERMISSIONS = [
        self::BENEFICIARIES,
        self::DASHBOARD,
    ];

    public function __construct()
    {
        $this->guardName = Guard::getDefaultName(Permission::class);
    }



    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert all permissions
        $permissions = collect(self::ADMIN_PERMISSIONS)->map(function ($permission) {
            return ['name' => $permission , 'guard_name' => $this->guardName];
        });


        foreach ($permissions as $permission) {
            Permission::query()->insert($permission);
        }




        $adminRole = Role::findByName(User::ROLE_ADMIN);
        foreach (self::ADMIN_PERMISSIONS as $permission) {
            $adminRole->givePermissionTo(Permission::findByName($permission));
        }

        $charityRole = Role::findByName(User::ROLE_CHARITY);
        foreach (self::CHARITY_PERMISSIONS as $permission) {
            $charityRole->givePermissionTo(Permission::findByName($permission));
        }
    }

}
