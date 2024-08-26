<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'Admin',
            'name' => 'Pro Admin',
            'userType' => 'owner',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        User::factory()->create([
            'username' => 'Worker',
            'name' => 'Native Worker ',
            'email' => 'worker@gmail.com',
            'password' => bcrypt('worker')
        ]);

        Category::factory(5)->create();
        Customer::factory(15)->create();
        Product::factory(35)->create();
    }
}
