<?php

namespace App\Services\Subscription;

use App\DTOs\PersonDTO;
use App\Repositories\SubscriptionRepository;
use App\Repositories\Storage\CsvSubscriptionRepository;

class SmsSubscriptionService implements SubscriptionServiceInterface
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct()
    {
        $this->subscriptionRepository = new CsvSubscriptionRepository(
            storage_path('app/private/sms.csv')
        );
    }

    public function add(int $id, PersonDTO $person): void
    {
        $this->subscriptionRepository->add($id, $person->phone);
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
        return 'smsSubscription';
    }
}
