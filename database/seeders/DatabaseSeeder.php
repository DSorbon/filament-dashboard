<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        Customer::factory(200)->create();

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        $user = User::updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name'     => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('Administrator');
    }
}
