<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyImageSeeder extends Seeder
{
    public function run()
    {
        $images = [];
        
        // Генерируем изображения для каждой недвижимости
        $propertyIds = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
        $imageId = 1;
        
        foreach ($propertyIds as $propertyId) {
            for ($i = 1; $i <= 6; $i++) {
                $images[] = [
                    'id' => $imageId,
                    'property_id' => $propertyId,
                    'image_path' => "properties/{$propertyId}/{$i}.jpg",
                    'created_at' => '2025-06-08 20:30:41',
                    'updated_at' => '2025-06-08 20:30:41'
                ];
                $imageId++;
            }
        }

        DB::table('property_images')->insert($images);
    }
}