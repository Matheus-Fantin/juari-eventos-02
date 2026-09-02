<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            'Casamentos',
            'Festas Infantis',
            '15 Anos',
            'Corporativo',
            'Aniversários',
            'Chá de Bebê',
            'Formaturas',
            'Outros',
        ];

        foreach ($tipos as $nome) {
            EventType::firstOrCreate(['nome' => $nome]);
        }
    }
}