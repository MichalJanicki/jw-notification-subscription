<?php

namespace App\Services\Notification;

use SplSubject;
use SplObserver;
use App\Repositories\SubscriptionRepository;

class EmailNotificationService implements SplObserver
{
    public function __construct(private SubscriptionRepository $subscriptionRepository) {}

    public function update(SplSubject $subject): void
    {
        // send message
    }
}
