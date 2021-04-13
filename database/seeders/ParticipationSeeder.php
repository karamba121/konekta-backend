<?php

namespace Database\Seeders;

use App\Models\Participation;
use Illuminate\Database\Seeder;

class ParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participation::create([
            'first_name' => 'Carlos',
            'last_name' => 'Moura',
            'participation' => 5
        ]);

        Participation::create([
            'first_name' => 'Fernanda',
            'last_name' => 'Oliveira',
            'participation' => 15
        ]);

        Participation::create([
            'first_name' => 'Hugo',
            'last_name' => 'Silva',
            'participation' => 20
        ]);

        Participation::create([
            'first_name' => 'Eliza',
            'last_name' => 'Souza',
            'participation' => 20
        ]);

        Participation::create([
            'first_name' => 'Anderson',
            'last_name' => 'Santos',
            'participation' => 40
        ]);
    }
}
