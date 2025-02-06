<?php

namespace App\Repositories;

interface SubscriptionRepository
{
    public function add(int $id, string $value): void;

    public function remove(int $id): void;

    public function isSubscribing(int $id): bool;

    public function getAllSubscribers(): array;
}
