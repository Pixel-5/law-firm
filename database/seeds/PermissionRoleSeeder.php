<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(1)->permissions()->sync($user_permissions);
        Role::findOrFail(2)->permissions()->sync($user_permissions);
        Role::findOrFail(3)->permissions()->sync($admin_permissions->pluck('id'));

    }
}
