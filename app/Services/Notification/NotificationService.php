<?php

namespace App\Services\Notification;

use SplSubject;
use SplObserver;
use SplObjectStorage;

class NotificationService implements SplSubject
{
    private SplObjectStorage $observers;
    private string $content;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function send(string $content): void
    {
        $this->content = $content;
        $this->notify();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
