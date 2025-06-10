<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutCompanyServices;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $servicesData = [
            [
                'title' => [
                    'ru' => 'Жилищное строительство',
                    'en' => 'Residential Construction'
                ],
                'content' => [
                    'ru' => 'Строительство многоквартирных жилых комплексов (эконом, комфорт и бизнес-класса). Таунхаусы и коттеджные посёлки. Комплексное освоение территорий. Полный цикл реализации проекта от проектирования до сдачи в эксплуатацию.',
                    'en' => 'Construction of multi-apartment residential complexes (economy, comfort and business class). Townhouses and cottage settlements. Comprehensive land development. Full project implementation cycle from design to commissioning.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Коммерческая недвижимость',
                    'en' => 'Commercial Real Estate'
                ],
                'content' => [
                    'ru' => 'Бизнес-центры классов A и B+. Логистические центры и складские помещения. Строительство "под ключ" с учетом потребностей арендаторов.',
                    'en' => 'Business centers of class A and B+. Logistics centers and warehouse facilities. Turnkey construction taking into account tenants\' needs.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Проектирование и дизайн',
                    'en' => 'Design and Engineering'
                ],
                'content' => [
                    'ru' => 'Разработка концепций объектов недвижимости. Архитектурное проектирование. Инженерное проектирование всех систем здания. Дизайн интерьеров общественных пространств.',
                    'en' => 'Development of real estate concepts. Architectural design. Engineering design of all building systems. Interior design of public spaces.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Управление недвижимостью',
                    'en' => 'Property Management'
                ],
                'content' => [
                    'ru' => 'Техническое обслуживание зданий. Управление коммерческими объектами. Обеспечение безопасности.',
                    'en' => 'Building maintenance. Commercial property management. Security provision.'
                ]
            ]
        ];

        foreach ($servicesData as $item) {
            AboutCompanyServices::create($item);
        }

        $this->command->info('Услуги успешно заполнены!');
    }
}