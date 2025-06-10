<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutCompanyHistory;

class HistorySeeder extends Seeder
{
    public function run()
    {
        $historyData = [
            [
                'title' => [
                    'ru' => 'Основание',
                    'en' => 'Foundation'
                ],
                'content' => [
                    'ru' => 'СтройИнвест была основана в 2005 году группой профессионалов строительной отрасли с опытом более 15 лет. Изначально компания специализировалась на жилищном строительстве в небольших масштабах.',
                    'en' => 'StroyInvest was founded in 2005 by a group of construction industry professionals with over 15 years of experience. Initially, the company specialized in small-scale residential construction.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Становление',
                    'en' => 'Development'
                ],
                'content' => [
                    'ru' => 'В 2008-2010 годы, несмотря на экономический кризис, компания смогла не только сохранить свои позиции на рынке, но и укрепить их, завершив все начатые проекты в срок и с высоким качеством.',
                    'en' => 'In 2008-2010, despite the economic crisis, the company was able not only to maintain its market position, but also to strengthen it by completing all started projects on time and with high quality.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Расширение',
                    'en' => 'Expansion'
                ],
                'content' => [
                    'ru' => 'В 2012 году СтройИнвест вышла на рынок коммерческой недвижимости, начав строительство первого бизнес-центра класса B+. В 2015 году компания открыла второй офис в соседнем регионе.',
                    'en' => 'In 2012, StroyInvest entered the commercial real estate market by starting construction of its first B+ class business center. In 2015, the company opened a second office in a neighboring region.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Современность',
                    'en' => 'Present Day'
                ],
                'content' => [
                    'ru' => 'За последние годы СтройИнвест реализовала более 25 масштабных проектов общей площадью свыше 350 000 кв. м. Сегодня компания входит в ТОП-15 застройщиков региона и продолжает расширять географию своей деятельности.',
                    'en' => 'In recent years, StroyInvest has implemented more than 25 large-scale projects with a total area of over 350,000 sq. m. Today the company is among the TOP-15 developers in the region and continues to expand its geographical presence.'
                ]
            ],
            [
                'title' => [
                    'ru' => 'Миссия компании',
                    'en' => 'Company Mission'
                ],
                'content' => [
                    'ru' => 'Создавать надежные, комфортные и современные объекты недвижимости, повышая качество жизни наших клиентов и меняя облик городов к лучшему.',
                    'en' => 'To create reliable, comfortable and modern real estate properties, improving the quality of life of our clients and changing the appearance of cities for the better.'
                ]
            ]
        ];

        foreach ($historyData as $item) {
            AboutCompanyHistory::create($item);
        }

        $this->command->info('История компании успешно заполнена!');
    }
}