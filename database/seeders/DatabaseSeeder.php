<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Database\Seeder;

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

        $post = new Post();
        $post->name = ['ru' => 'Загаловка', 'en' => 'Title'];
        $post->slug = ['ru' => 'zagalovka', 'en' => 'title'];
        $post->description = ['ru' => 'Информация', 'en' => 'Description'];
        $post->save();
//        $this->call([
//            RoleSeeder::class,
//            PermissionSeeder::class,
//        ]);
    }
}
