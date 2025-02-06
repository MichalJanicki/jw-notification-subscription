<?php

namespace App\DTOs;

readonly class PersonDTO
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public bool $smsSubscription,
        public bool $emailSubscription,
    ) {
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'sms_subscription' => $this->smsSubscription,
            'email_subscription' => $this->emailSubscription,
        ];
    }
}
