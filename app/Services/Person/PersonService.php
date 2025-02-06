<?php

namespace App\Services\Person;

use App\Models\Person;
use App\DTOs\PersonDTO;
use App\Records\PersonRecord;
use App\Repositories\PersonRepositoryInterface;
use App\Services\Subscription\SmSSubscriptionService;
use App\Services\Subscription\EmailSubscriptionService;

class PersonService implements PersonServiceInterface
{
    private const array SUBSCRIPTION_SERVICES = [
        EmailSubscriptionService::class,
        SmSSubscriptionService::class
    ];

    public function __construct(private PersonRepositoryInterface $personRepository) {}

    public function getAll(): array
    {
        $persons = $this->personRepository->getAll();

        $result = [];

        foreach ($persons as $person) {
            $result[] = $this->mapToRecord($person->toArray());
        }

        return $result;
    }

    public function findByIdOrFail(int $id): PersonRecord
    {
        $person = $this->personRepository->findByIdOrFail($id);
        return $this->mapToRecord($person->toArray());
    }

    public function create(PersonDTO $person): void
    {
        $personModel = new Person();
        $personModel->first_name = $person->firstName;
        $personModel->last_name = $person->lastName;
        $personModel->email = $person->email;
        $personModel->phone = $person->phone;

        $this->personRepository->create($personModel);
        $this->updateSubscription($personModel->id, $person);
    }

    public function update(int $id, PersonDTO $person): void
    {
        $this->personRepository->update($id, $person);
        $this->updateSubscription($id, $person);
    }

    public function delete(int $id): void
    {
        $this->personRepository->delete($id);

        foreach (self::SUBSCRIPTION_SERVICES as $subscriptionServices) {
            $serviceInstance = new $subscriptionServices();
            $serviceInstance->remove($id);
        }
    }

    private function updateSubscription(int $id, PersonDTO $person): void
    {
        foreach (self::SUBSCRIPTION_SERVICES as $subscriptionServices) {
            $serviceInstance = new $subscriptionServices();
            $person->{$serviceInstance->getFieldName()} ? $serviceInstance->add($id, $person) : $serviceInstance->remove($id);
        }
    }

    private function mapToRecord(array $data): PersonRecord
    {
        foreach (self::SUBSCRIPTION_SERVICES as $subscriptionServices) {
            $serviceInstance = new $subscriptionServices();
            $data[$serviceInstance->getFieldName()] = $serviceInstance->isSubscribing($data['id']);
        }

        return new PersonRecord(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['smsSubscription'],
            $data['emailSubscription'],
        );
    }
}
