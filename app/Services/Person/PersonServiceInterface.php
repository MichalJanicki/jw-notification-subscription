<?php

namespace App\Services\Person;

use App\DTOs\PersonDTO;
use App\Records\PersonRecord;

interface PersonServiceInterface
{
    public function getAll(): array;

    public function findByIdOrFail(int $id): PersonRecord;

    public function create(PersonDTO $person): void;

    public function update(int $id, PersonDTO $person): void;

    public function delete(int $id): void;
}
