<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    protected string $guardName;

    public function __construct()
    {
        $this->guardName = Guard::getDefaultName(Permission::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            ['name' => User::ROLE_ADMIN, 'guard_name' => $this->guardName],
            ['name' => User::ROLE_CHARITY, 'guard_name' => $this->guardName],
        ];

        Role::query()->upsert($roles, ['name'], ['name', 'guard_name']);
    }
}
