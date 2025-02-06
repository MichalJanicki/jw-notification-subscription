<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\DTOs\PersonDTO;
use App\Models\Person;
use App\Repositories\PersonRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentPersonRepository implements PersonRepositoryInterface
{
    public function getAll(): Collection
    {
        return Person::all();
    }

    public function findByIdOrFail(int $id): Person
    {
        return Person::findOrFail($id);
    }

    public function create(Person $person): void
    {
        $person->save();
    }

    public function update(int $id, PersonDTO $person): void
    {
        Person::findOrFail($id)->update($person->toArray());
    }

    public function delete(int $id): void
    {
        Person::findOrFail($id)->delete();
    }
}
