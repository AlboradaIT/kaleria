<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Apartment;
use App\Models\Booking;
use App\Models\Stay;
use App\Models\WorkOrder;
use App\Models\Rate;
use Spatie\Permission\Models\Role;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $workerRole = Role::firstOrCreate(['name' => 'worker']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@kaleria.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password')
            ]
        );
        $admin->assignRole($adminRole);

        // Create worker users
        $worker1 = User::firstOrCreate(
            ['email' => 'maria@kaleria.com'],
            [
                'name' => 'María García',
                'password' => bcrypt('password')
            ]
        );
        $worker1->assignRole($workerRole);

        $worker2 = User::firstOrCreate(
            ['email' => 'carlos@kaleria.com'],
            [
                'name' => 'Carlos López',
                'password' => bcrypt('password')
            ]
        );
        $worker2->assignRole($workerRole);

        // Create apartments
        $apt1 = Apartment::firstOrCreate(
            ['external_id' => 'APT001'],
            [
                'name' => 'Apartamento Centro Histórico',
                'metadata' => ['address' => 'Calle Mayor 123, Madrid']
            ]
        );

        $apt2 = Apartment::firstOrCreate(
            ['external_id' => 'APT002'],
            [
                'name' => 'Estudio Moderno Chamberí',
                'metadata' => ['address' => 'Calle Fuencarral 456, Madrid']
            ]
        );

        // Create rates
        Rate::firstOrCreate(
            ['worker_id' => $worker1->id, 'apartment_id' => $apt1->id],
            [
                'price' => 45.00,
                'effective_from' => now()
            ]
        );

        Rate::firstOrCreate(
            ['worker_id' => $worker1->id, 'apartment_id' => $apt2->id],
            [
                'price' => 35.00,
                'effective_from' => now()
            ]
        );

        Rate::firstOrCreate(
            ['worker_id' => $worker2->id, 'apartment_id' => $apt1->id],
            [
                'price' => 50.00,
                'effective_from' => now()
            ]
        );

        // Create sample bookings
        $booking1 = Booking::firstOrCreate(
            ['external_id' => 'BK001'],
            [
                'apartment_id' => $apt1->id,
                'check_in_date' => now()->addDays(1)->toDateString(),
                'check_out_date' => now()->addDays(4)->toDateString(),
                'guest_name' => 'Juan Pérez',
                'guests_count' => 2,
                'status' => 'confirmed'
            ]
        );

        // Create sample work orders
        WorkOrder::firstOrCreate([
            'apartment_id' => $apt1->id,
            'title' => 'Limpieza después de salida',
            'scheduled_start' => now()->addHours(2),
            'scheduled_end' => now()->addHours(4),
            'status' => 'pending',
            'admin_notes' => 'Limpieza después de salida de huéspedes'
        ]);

        WorkOrder::firstOrCreate([
            'apartment_id' => $apt2->id,
            'assigned_to' => $worker1->id,
            'title' => 'Limpieza programada',
            'scheduled_start' => now()->addDays(1),
            'scheduled_end' => now()->addDays(1)->addHours(2),
            'status' => 'assigned',
            'price' => 35.00,
            'admin_notes' => 'Limpieza programada regular'
        ]);
    }
}
