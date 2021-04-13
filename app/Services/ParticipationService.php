<?php

namespace App\Services;

use App\Models\Participation;
use Exception;
use Illuminate\Support\Collection;

class ParticipationService implements ParticipationServiceContract
{
    public function getAll(): Collection
    {
        return Participation::select(['first_name', 'last_name', 'participation'])->get();
    }

    public function store(array $validatedData): Participation
    {
        $alreadExistsInDatabase = Participation::where(['first_name' => $validatedData['first_name'], 'last_name' => $validatedData['last_name']])->count() > 0;

        if ($alreadExistsInDatabase) {
            throw new Exception('Já existe alguém com esse nome e sobrenome no banco de dados.');
        }

        $totalOfParticipations = floatval(Participation::sum('participation'));

        if ($totalOfParticipations == 100) {
            throw new Exception('O máximo de participação já foi alcançado (100%). Remova ou diminua alguma participação.');
        }

        if ($totalOfParticipations + $validatedData['participation'] > 100) {
            throw new Exception('Uma participação com este valor vai ultrapassar o máximo (100%).');
        }

        $participation = Participation::create($validatedData);

        return $participation;
    }

    public function update(array $validatedData, Participation $participation): Participation
    {
        $participation->update($validatedData);

        $totalOfParticipations = floatval(Participation::whereNotIn('id', [$participation->id])->get()->sum('participation'));

        if ($totalOfParticipations + $validatedData['participation'] > 100) {
            throw new Exception('Uma participação com este valor vai ultrapassar o máximo (100%).');
        }

        return $participation;
    }

    public function delete(Participation $participation): void
    {
        $participation->delete();
    }
}
