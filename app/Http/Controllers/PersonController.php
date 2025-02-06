<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Services\Person\PersonServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class PersonController extends Controller
{
    public function __construct(private readonly PersonServiceInterface $personService) {}

    public function index(): View
    {
        return view('persons.index', [
            'persons' => $this->personService->getAll()
        ]);
    }

    public function create(): View
    {
        return view('persons.create');
    }

    public function store(PersonRequest $request): RedirectResponse
    {
        $this->personService->create($request->getDto());
        return redirect()->route('persons.index')->with('success', 'Person was created!');
    }

    public function edit(int $id): View
    {
        return view('persons.edit', [
            'person' => $this->personService->findByIdOrFail($id)
        ]);
    }

    public function update(int $id, PersonRequest $request): RedirectResponse
    {
        $this->personService->update($id, $request->getDto());
        return redirect()->route('persons.index')->with('success', 'Person was updated!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->personService->delete($id);
        return redirect()->route('persons.index')->with('success', 'Person removed!');;;
    }
}
