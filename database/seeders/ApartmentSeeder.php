<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = [
            [
                'name' => 'Sunny Downtown Studio',
                'address' => '123 Main Street, Apt 4B',
                'city' => 'Barcelona',
                'postal_code' => '08001',
                'country' => 'Spain',
                'max_guests' => 2,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'external_id' => 'SMOOBU_001',
                'is_active' => true,
                'description' => 'Great location near metro station',
            ],
            [
                'name' => 'Cozy Beach Apartment',
                'address' => '456 Ocean Drive, 2nd Floor',
                'city' => 'Valencia',
                'postal_code' => '46001',
                'country' => 'Spain',
                'max_guests' => 4,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'external_id' => 'SMOOBU_002',
                'is_active' => true,
                'description' => '5 minutes walk to the beach',
            ],
            [
                'name' => 'Modern City Loft',
                'address' => '789 Innovation Street, Floor 3',
                'city' => 'Madrid',
                'postal_code' => '28001',
                'country' => 'Spain',
                'max_guests' => 6,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'external_id' => 'SMOOBU_003',
                'is_active' => true,
                'description' => 'Recently renovated with modern amenities',
            ],
            [
                'name' => 'Historic Quarter Flat',
                'address' => '321 Gothic Street',
                'city' => 'Barcelona',
                'postal_code' => '08002',
                'country' => 'Spain',
                'max_guests' => 3,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'external_id' => 'SMOOBU_004',
                'is_active' => false,
                'description' => 'Under maintenance - balcony repair needed',
            ],
            [
                'name' => 'Luxury Penthouse',
                'address' => '654 Elite Avenue, Top Floor',
                'city' => 'Marbella',
                'postal_code' => '29600',
                'country' => 'Spain',
                'max_guests' => 8,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'external_id' => 'SMOOBU_005',
                'is_active' => true,
                'description' => 'Premium location with sea views',
            ],
        ];

        foreach ($apartments as $apartmentData) {
            Apartment::create($apartmentData);
        }
    }
}
