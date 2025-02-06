<?php

namespace App\Services\Subscription;

use App\DTOs\PersonDTO;
use App\Repositories\Storage\CsvSubscriptionRepository;
use App\Repositories\SubscriptionRepository;

class EmailSubscriptionService implements SubscriptionServiceInterface
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct()
    {
        $this->subscriptionRepository = new CsvSubscriptionRepository(
            storage_path('app/private/email.csv')
        );
    }

    public function add(int $id, PersonDTO $person): void
    {
        $this->subscriptionRepository->add($id, $person->email);
    }

    public function remove(int $id): void
    {
        $this->subscriptionRepository->remove($id);
    }

    public function isSubscribing(int $id): bool
    {
        return $this->subscriptionRepository->isSubscribing($id);
    }

    public function getFieldName(): string
    {
        return 'emailSubscription';
    }
}
