<?php

namespace Database\Seeders;

use App\Models\EquipmentPedStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 8) as $i) {
            foreach (range(1, 10) as $j) {
                EquipmentPedStock::create([
                    'equipment_id' => $i,
                    'ped_category_id' => $j,
                    'qty_available' => rand(20, 50)
                ]);
            }
        }
    }
}
