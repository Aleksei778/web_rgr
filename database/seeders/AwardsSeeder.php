<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutCompanyAwards;

class AwardsSeeder extends Seeder
{
    public function run(): void
    {
        $awardsData = [
            [
                'title' => [
                    'ru' => 'Лауреат премии "Надежный застройщик России"',
                    'en' => 'Winner of "Reliable Developer of Russia" Award'
                ],
                'content' => [
                    'ru' => 'Лауреат премии "Надежный застройщик России" (2018, 2020, 2022)',
                    'en' => 'Winner of "Reliable Developer of Russia" Award (2018, 2020, 2022)'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Победитель региональной премии "Объект года"',
                    'en' => 'Winner of Regional "Object of the Year" Award'
                ],
                'content' => [
                    'ru' => 'Победитель региональной премии "Объект года" в номинации "Лучший жилой комплекс" (2019)',
                    'en' => 'Winner of regional "Object of the Year" award in "Best Residential Complex" category (2019)'
                ]
            ],
        ];

        foreach ($awardsData as $item) {
            AboutCompanyAwards::create($item);
        }

        $this->command->info('Награды успешно заполнены!');
    }
}