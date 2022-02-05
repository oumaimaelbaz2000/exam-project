<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'question_create',
            ],
            [
                'id'    => 18,
                'title' => 'question_edit',
            ],
            [
                'id'    => 19,
                'title' => 'question_show',
            ],
            [
                'id'    => 20,
                'title' => 'question_delete',
            ],
            [
                'id'    => 21,
                'title' => 'question_access',
            ],
            [
                'id'    => 22,
                'title' => 'certificat_create',
            ],
            [
                'id'    => 23,
                'title' => 'certificat_edit',
            ],
            [
                'id'    => 24,
                'title' => 'certificat_show',
            ],
            [
                'id'    => 25,
                'title' => 'certificat_delete',
            ],
            [
                'id'    => 26,
                'title' => 'certificat_access',
            ],
            [
                'id'    => 27,
                'title' => 'subject_create',
            ],
            [
                'id'    => 28,
                'title' => 'subject_edit',
            ],
            [
                'id'    => 29,
                'title' => 'subject_show',
            ],
            [
                'id'    => 30,
                'title' => 'subject_delete',
            ],
            [
                'id'    => 31,
                'title' => 'subject_access',
            ],
            [
                'id'    => 32,
                'title' => 'examan_create',
            ],
            [
                'id'    => 33,
                'title' => 'examan_edit',
            ],
            [
                'id'    => 34,
                'title' => 'examan_show',
            ],
            [
                'id'    => 35,
                'title' => 'examan_delete',
            ],
            [
                'id'    => 36,
                'title' => 'examan_access',
            ],
            [
                'id'    => 37,
                'title' => 'entrainement_create',
            ],
            [
                'id'    => 38,
                'title' => 'entrainement_edit',
            ],
            [
                'id'    => 39,
                'title' => 'entrainement_show',
            ],
            [
                'id'    => 40,
                'title' => 'entrainement_delete',
            ],
            [
                'id'    => 41,
                'title' => 'entrainement_access',
            ],
            [
                'id'    => 42,
                'title' => 'statistique_create',
            ],
            [
                'id'    => 43,
                'title' => 'statistique_edit',
            ],
            [
                'id'    => 44,
                'title' => 'statistique_show',
            ],
            [
                'id'    => 45,
                'title' => 'statistique_delete',
            ],
            [
                'id'    => 46,
                'title' => 'statistique_access',
            ],
            [
                'id'    => 47,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
