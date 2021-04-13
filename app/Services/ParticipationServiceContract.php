<?php

namespace App\Services;

use App\Models\Participation;
use Illuminate\Support\Collection;

interface ParticipationServiceContract
{
    public function getAll(): Collection;
    public function store(array $validatedData): Participation;
    public function update(array $validatedData, Participation $participation): Participation;
    public function delete(Participation $participation): void;
}
