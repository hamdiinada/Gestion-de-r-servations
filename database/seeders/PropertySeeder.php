<?php

namespace Database\Seeders;
use App\Models\Property;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::create([
            'name' => 'Villa avec piscine',
            'description' => 'Magnifique villa située en bord de mer, idéale pour les vacances en famille. Comprend 4 chambres, 3 salles de bain, une grande piscine et un accès direct à la plage.',
            'price_per_night' => 350.00,
        ]);

        Property::create([
            'name' => 'Appartement cosy en centre-ville',
            'description' => 'Appartement moderne et entièrement équipé au cœur de la ville, proche de toutes commodités. Parfait pour les couples ou les voyageurs d\'affaires.',
            'price_per_night' => 80.00,
        ]);

        Property::create([
            'name' => 'Chalet de montagne',
            'description' => 'Charmant chalet en bois niché dans les montagnes, offrant une vue imprenable. Idéal pour les amoureux de la nature et les sports d\'hiver.',
            'price_per_night' => 200.00,
        ]);
    }
}
