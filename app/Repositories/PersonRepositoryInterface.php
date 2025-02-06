<?php

namespace App\Repositories;

use App\DTOs\PersonDTO;
use App\Models\Person;
use Illuminate\Support\Collection;

interface PersonRepositoryInterface
{
    public function getAll(): Collection;

    public function findByIdOrFail(int $id);

    public function create(Person $person): void;

    public function update(int $id, PersonDTO $person): void;

    public function delete(int $id): void;
}

