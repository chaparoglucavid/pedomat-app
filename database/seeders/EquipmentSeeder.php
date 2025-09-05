<?php

namespace Database\Seeders;

use App\Models\Equipments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipmentData = [
            [
                'equipment_number' => 'EQ-10001',
                'equipment_name' => 'Lifting Crane',
                'general_capacity' => 120,
                'battery_level' => 85,
                'current_address' => '215 Baker St, London',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10002',
                'equipment_name' => 'Heavy Dozer',
                'general_capacity' => 80,
                'battery_level' => 60,
                'current_address' => '45 Wall St, New York',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10003',
                'equipment_name' => 'Drilling Rig',
                'general_capacity' => 150,
                'battery_level' => 95,
                'current_address' => '10 Downing St, London',
                'equipment_status' => 'deactive',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10004',
                'equipment_name' => 'Forklift A',
                'general_capacity' => 25,
                'battery_level' => 45,
                'current_address' => '99 Market St, San Francisco',
                'equipment_status' => 'under_repair',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10005',
                'equipment_name' => 'Excavator Model B',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => '55 Grand Blvd, Los Angeles',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10057',
                'equipment_name' => 'Excavator Model A',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => '55 Grand Blvd, Los Angeles',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10053',
                'equipment_name' => 'Excavator Model Z',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => '55 Grand Blvd, Los Angeles',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-20753',
                'equipment_name' => 'Excavator Model D',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => '55 Grand Blvd, Los 2 floor',
                'equipment_status' => 'active',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('equipments')->insert($equipmentData);
    }
}
