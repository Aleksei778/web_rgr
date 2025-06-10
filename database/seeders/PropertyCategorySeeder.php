<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            // Родительские категории
            [
                'id' => 13, 
                'name' => 'Жилая недвижимость', 
                'parent_id' => null, 
                'created_at' => '2025-04-03 19:40:21'
            ],
            [
                'id' => 14, 
                'name' => 'Коммерческая недвижимость', 
                'parent_id' => null, 
                'created_at' => '2025-04-03 19:40:21'
            ],
            [
                'id' => 15, 
                'name' => 'Элитная недвижимость', 
                'parent_id' => null, 
                'created_at' => '2025-04-03 19:40:21'
            ],
            // Дочерние категории коммерческой недвижимости
            [
                'id' => 17, 
                'name' => 'Офисы', 
                'parent_id' => 14, 
                'created_at' => '2025-04-03 19:42:04'
            ],
            [
                'id' => 18, 
                'name' => 'Торговые помещения', 
                'parent_id' => 14, 
                'created_at' => '2025-04-03 19:42:04'
            ],
            // Дочерние категории жилой недвижимости
            [
                'id' => 20, 
                'name' => 'Однокомнатные квартиры', 
                'parent_id' => 13, 
                'created_at' => '2025-04-03 19:42:56'
            ],
            [
                'id' => 21, 
                'name' => 'Многокомнатные квартиры', 
                'parent_id' => 13, 
                'created_at' => '2025-04-03 19:42:56'
            ],
            // Дочерние категории элитной недвижимости
            [
                'id' => 22, 
                'name' => 'Особняки и пентхаусы', 
                'parent_id' => 15, 
                'created_at' => '2025-04-03 19:42:56'
            ],
        ];

        DB::table('property_categories')->insert($categories);
    }
}