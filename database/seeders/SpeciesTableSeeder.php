<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $species = [
            'Cachorro',
            'Gato',
            'Gado',
            'Cavalo',
            'Papagaio',
            'Coelho',
            'Peixe Betta',
            'Pato',
            'Hamster',
            'Galinha',
            'Periquito',
            'Porco',
            'Canário',
            'Calopsita',
            'Cobra de Estimação',
        ];

        foreach ($species as $specie) {
            DB::table('species')->insert([
                'name' => $specie,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
