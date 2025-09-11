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
                'equipment_name' => 'Pedomat – Nizami',
                'general_capacity' => 120,
                'battery_level' => 85,
                'current_address' => 'Nizami küçəsi 69, Səbail, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.3729500,
                'longitude' => 49.8383000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10002',
                'equipment_name' => 'Pedomat – 28 May',
                'general_capacity' => 80,
                'battery_level' => 60,
                'current_address' => '28 May küçəsi 15, Nəsimi, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.3776000,
                'longitude' => 49.8469000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10003',
                'equipment_name' => 'Pedomat – Füzuli',
                'general_capacity' => 150,
                'battery_level' => 95,
                'current_address' => 'Füzuli küçəsi 49, Yasamal, Bakı',
                'equipment_status' => 'deactive',
                'latitude' => 40.3828000,
                'longitude' => 49.8545000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10004',
                'equipment_name' => 'Pedomat – Rəşid Behbudov',
                'general_capacity' => 25,
                'battery_level' => 45,
                'current_address' => 'Rəşid Behbudov küçəsi 24, Nəsimi, Bakı',
                'equipment_status' => 'under_repair',
                'latitude' => 40.3799000,
                'longitude' => 49.8520000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10005',
                'equipment_name' => 'Pedomat – Tbilisi pr.',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => 'Tbilisi prospekti 105, Yasamal, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.4099000,
                'longitude' => 49.8145000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10057',
                'equipment_name' => 'Pedomat – Heydər Əliyev pr.',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => 'Heydər Əliyev prospekti 89, Nərimanov, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.4215000,
                'longitude' => 49.9339000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-10053',
                'equipment_name' => 'Pedomat – Azadlıq pr.',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => 'Azadlıq prospekti 154, Binəqədi, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.4465000,
                'longitude' => 49.8229000,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'equipment_number' => 'EQ-20753',
                'equipment_name' => 'Pedomat – Zərifə Əliyeva',
                'general_capacity' => 90,
                'battery_level' => 70,
                'current_address' => 'Zərifə Əliyeva küçəsi 23, Səbail, Bakı',
                'equipment_status' => 'active',
                'latitude' => 40.3708000,
                'longitude' => 49.8446000,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ];

        DB::table('equipments')->insert($equipmentData);
    }
}
