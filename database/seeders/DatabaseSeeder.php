<?php

namespace Database\Seeders;

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
        $this->call([
            RoleAndPermissionSeeder::class,
            ApartmentSeeder::class,
        ]);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@kaleria.com',
        ]);
        $admin->assignRole('admin');

        // Create worker user
        $worker = User::factory()->create([
            'name' => 'Worker User',
            'email' => 'worker@kaleria.com',
        ]);
        $worker->assignRole('worker');
    }
}
