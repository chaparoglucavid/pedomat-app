<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedCategories = [
            [
                'category_name' => 'Gündəlik istifadəli',
                'reason_for_use' => 'Yüngül və ya normal gündəlik menstrual axıntı üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Gecə istifadəli',
                'reason_for_use' => 'Gecə boyu qoruma və güclü axıntı üçün nəzərdə tutulub',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Nazik (ultra thin)',
                'reason_for_use' => 'Yüngül və orta axıntı zamanı daha rahat və gizli istifadə üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Maxi qoruyucu',
                'reason_for_use' => 'Daha çox hopdurma qabiliyyəti ilə güclü axıntılar üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Gündəlik qoruyucu (pantyliner)',
                'reason_for_use' => 'Gündəlik təmizlik, ləkələnmə və ya dövrün əvvəl/son günləri üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
        ];

        DB::table('ped_categories')->insert($pedCategories);
    }
}
