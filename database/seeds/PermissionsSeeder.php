<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'schedule_create',
            ],
            [
                'id'    => '18',
                'title' => 'schedule_edit',
            ],
            [
                'id'    => '19',
                'title' => 'schedule_show',
            ],
            [
                'id'    => '20',
                'title' => 'schedule_delete',
            ],
            [
                'id'    => '21',
                'title' => 'schedule_access',
            ],
            [
                'id'    => '22',
                'title' => 'file_access',
            ],
            [
                'id'    => '23',
                'title' => 'file_edit',
            ],
            [
                'id'    => '24',
                'title' => 'file_delete',
            ],
            [
                'id'    => '25',
                'title' => 'file_create',
            ],
            [
                'id'    => '26',
                'title' => 'file_show',
            ],
            [
                'id'    => '27',
                'title' => 'case_access',
            ],
            [
                'id'    => '28',
                'title' => 'case_create',
            ],
            [
                'id'    => '29',
                'title' => 'case_edit',
            ],
            [
                'id'    => '30',
                'title' => 'case_show',
            ],
            [
                'id'    => '31',
                'title' => 'case_delete',
            ],
            [
                'id'    => '32',
                'title' => 'case_assign',
            ],
            [
                'id'    => '33',
                'title' => 'profile_create',
            ],
            [
                'id'    => '34',
                'title' => 'profile_edit',
            ],
            [
                'id'    => '35',
                'title' => 'profile_show',
            ],
            [
                'id'    => '36',
                'title' => 'profile_delete',
            ],
            [
                'id'    => '37',
                'title' => 'profile_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
