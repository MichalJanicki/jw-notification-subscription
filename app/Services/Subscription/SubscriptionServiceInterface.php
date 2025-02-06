<?php

namespace App\Services\Subscription;

use App\DTOs\PersonDTO;

interface SubscriptionServiceInterface
{
    public function add(int $id, PersonDTO $person): void;

    public function remove(int $id): void;

    public function isSubscribing(int $id): bool;

    public function getFieldName(): string;
}
