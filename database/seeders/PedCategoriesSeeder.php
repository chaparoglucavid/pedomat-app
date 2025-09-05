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
            [
                'category_name' => 'Üzvi pambıq',
                'reason_for_use' => 'Həssas dəri üçün təbii və kimyəvi tərkibsiz seçim',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Doğuşdan sonrakı (postpartum)',
                'reason_for_use' => 'Doğuşdan sonrakı güclü axıntılar üçün yüksək hopdurma qabiliyyəti',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Gənc qızlar üçün',
                'reason_for_use' => 'Kiçik ölçü və rahatlıq – ilk menstruasiya dövrləri üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Təkrar istifadə olunan parça ped',
                'reason_for_use' => 'Ekoloji cəhətdən təmiz, yuyula bilən alternativ',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'active',
            ],
            [
                'category_name' => 'Ətirli pedlər',
                'reason_for_use' => 'Menstruasiya zamanı qoxuya nəzarət üçün',
                'unit_price' => number_format(random_int(50, 100) / 100, 2, '.', ''),
                'status' => 'inactive',
            ],
        ];

        DB::table('ped_categories')->insert($pedCategories);
    }
}
