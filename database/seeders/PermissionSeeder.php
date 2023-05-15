<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPermissions();
        $this->givePermissionToRole();
    }

    private function seedPermissions()
    {
        foreach (config('settings.permissions') as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }
    }

    private function givePermissionToRole()
    {
        foreach (config('settings.role_has_permissions') as $name => $permissions) {
            $role = Role::firstWhere('name', $name);
            $role->syncPermissions($permissions);
        }
    }
}
