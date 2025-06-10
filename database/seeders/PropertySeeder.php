<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $properties = [
            [
                'id' => 2,
                'category_id' => 20,
                'title' => 'Студия на Якиманке',
                'address' => 'Москва, ул. Большая Якиманка, д. 22',
                'latitude' => 55.7342,
                'longitude' => 37.6115,
                'price' => 9500000.00,
                'is_active' => true,
                'description' => 'Студия 35 м², современный дизайн',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 3,
                'category_id' => 21,
                'title' => 'Уютная квартира на Арбате',
                'address' => 'Москва, ул. Арбат, д. 24',
                'latitude' => 55.7503,
                'longitude' => 37.5918,
                'price' => 15000000.00,
                'is_active' => true,
                'description' => '2-комнатная квартира, 60 м², ремонт',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 4,
                'category_id' => 21,
                'title' => 'Квартира на Ходынке',
                'address' => 'Москва, Ходынский бульвар, д. 2',
                'latitude' => 55.785,
                'longitude' => 37.5316,
                'price' => 22000000.00,
                'is_active' => true,
                'description' => '3-комнатная квартира, 85 м², новостройка',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 5,
                'category_id' => 21,
                'title' => 'Квартира на Садовой',
                'address' => 'Москва, ул. Садовая-Кудринская, д. 8',
                'latitude' => 55.7638,
                'longitude' => 37.5862,
                'price' => 18000000.00,
                'is_active' => true,
                'description' => '70 м², 2 спальни, рядом парк',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 6,
                'category_id' => 17,
                'title' => 'Офис на Новом Арбате',
                'address' => 'Москва, ул. Новый Арбат, д. 21',
                'latitude' => 55.752,
                'longitude' => 37.578,
                'price' => 30000000.00,
                'is_active' => true,
                'description' => 'Офисное помещение, 100 м², центр',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 7,
                'category_id' => 18,
                'title' => 'Помещение на Кутузовском',
                'address' => 'Москва, Кутузовский пр., д. 33',
                'latitude' => 55.7398,
                'longitude' => 37.5469,
                'price' => 35000000.00,
                'is_active' => true,
                'description' => '120 м², под офис',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 8,
                'category_id' => 18,
                'title' => 'Торговая площадь на Тверской',
                'address' => 'Москва, ул. Тверская, д. 15',
                'latitude' => 55.7605,
                'longitude' => 37.6071,
                'price' => 25000000.00,
                'is_active' => true,
                'description' => '50 м², высокий трафик',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 9,
                'category_id' => 22,
                'title' => 'Апартаменты на Пречистенке',
                'address' => 'Москва, ул. Пречистенка, д. 13',
                'latitude' => 55.744,
                'longitude' => 37.592,
                'price' => 120000000.00,
                'is_active' => true,
                'description' => '200 м², вид на реку, премиум-класс',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 10,
                'category_id' => 22,
                'title' => 'Особняк на Остоженке',
                'address' => 'Москва, ул. Остоженка, д. 10',
                'latitude' => 55.7382,
                'longitude' => 37.5987,
                'price' => 150000000.00,
                'is_active' => true,
                'description' => '300 м², элитный ремонт, парковка',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 11,
                'category_id' => 22,
                'title' => 'Пентхаус на Ленинском',
                'address' => 'Москва, Ленинский пр., д. 45',
                'latitude' => 55.7101,
                'longitude' => 37.5868,
                'price' => 180000000.00,
                'is_active' => true,
                'description' => '250 м², терраса, панорамные окна',
                'created_at' => '2025-06-08 20:20:58',
                'updated_at' => '2025-06-08 20:20:58'
            ],
            [
                'id' => 14,
                'category_id' => 20,
                'title' => '1212',
                'address' => 'Севастополь',
                'latitude' => 33.524471,
                'longitude' => 44.61602,
                'price' => 1212.00,
                'is_active' => true,
                'description' => 'ывавы',
                'created_at' => '2025-06-08 20:31:03',
                'updated_at' => '2025-06-08 20:31:03'
            ]
        ];

        DB::table('properties')->insert($properties);
    }
}