<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Apartment permissions
            'view apartments',
            'create apartments',
            'edit apartments',
            'delete apartments',
            
            // Booking permissions
            'view bookings',
            'create bookings',
            'edit bookings',
            'delete bookings',
            
            // Stay permissions
            'view stays',
            'create stays',
            'edit stays',
            'delete stays',
            
            // Work order permissions
            'view work orders',
            'create work orders',
            'edit work orders',
            'delete work orders',
            'assign work orders',
            'accept work orders',
            'reject work orders',
            'complete work orders',
            
            // Rate permissions
            'view rates',
            'create rates',
            'edit rates',
            'delete rates',
            
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Webhook permissions
            'view webhook logs',
            
            // Report permissions
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $workerRole = Role::create(['name' => 'worker']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Worker gets limited permissions
        $workerRole->givePermissionTo([
            'view work orders',
            'accept work orders',
            'reject work orders',
            'complete work orders',
            'view apartments',
        ]);
    }
}
