<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'casamentos' => 'Casamentos',
            'festas-infantis' => 'Festas Infantis',
            '15-anos' => '15 Anos',
            'corporativo' => 'Corporativo',
            'aniversarios' => 'Aniversários',
            'cha-de-bebe' => 'Chá de Bebê',
            'formaturas' => 'Formaturas',
            'outros' => 'Outros',
        ];

        foreach ($categorias as $slug => $nome) {
            Gallery::firstOrCreate(['categoria' => $slug], ['nome' => $nome, 'tipo' => 'eventos']);
        }

        $gastronomia = [
            'gastronomia-festas-infantis' => 'Festas Infantis',
            'gastronomia-jantares-coqueteis' => 'Jantares & Coquetéis',
        ];

        foreach ($gastronomia as $slug => $nome) {
            Gallery::firstOrCreate(['categoria' => $slug], ['nome' => $nome, 'tipo' => 'gastronomia']);
        }
    }
}
