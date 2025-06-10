<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResetSeqSeeder extends Seeder
{
    public function run()
    {
        // Сбрасываем последовательности для всех таблиц
        $this->resetSequence('property_categories', 'id');
        $this->resetSequence('properties', 'id');
        $this->resetSequence('property_images', 'id');
    }

    private function resetSequence($tableName, $columnName)
    {
        // Получаем максимальное значение ID из таблицы
        $maxId = DB::table($tableName)->max($columnName) ?: 0;
        
        // Устанавливаем следующее значение последовательности
        $sequenceName = $tableName . '_' . $columnName . '_seq';
        DB::statement("ALTER SEQUENCE {$sequenceName} RESTART WITH " . ($maxId + 1));
        
        $this->command->info("Sequence {$sequenceName} reset to " . ($maxId + 1));
    }
}