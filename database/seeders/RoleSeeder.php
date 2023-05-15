<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('settings.roles') as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }
    }
}
