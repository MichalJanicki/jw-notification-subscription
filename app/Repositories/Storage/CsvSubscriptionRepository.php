<?php

declare(strict_types=1);

namespace App\Repositories\Storage;

use App\Repositories\SubscriptionRepository;
use RuntimeException;

class CsvSubscriptionRepository implements SubscriptionRepository
{
    public function __construct(private $filePath) {}

    public function add(int $id, string $value): void
    {
        $this->createFileIfNotExist();

        $subscriber = $this->findById($id);

        if (null !== $subscriber) {
            return;
        }

        $handle = fopen($this->filePath, 'a');

        if (false === $handle) {
            throw new RuntimeException('Unable to read file');
        }


        fputcsv($handle, [$id, $value]);
        fclose($handle);
    }

    public function remove(int $id): void
    {
        $this->createFileIfNotExist();

        $subscriber = $this->findById($id);

        if (null === $subscriber) {
            return;
        }

        $fileContent = file_get_contents($this->filePath);

        if (false === $fileContent) {
            throw new RuntimeException('Unable to read file');
        }

        $subscriberRecords = explode("\n", $fileContent);

        foreach ($subscriberRecords as $key => $record) {
            $subscriberData = explode(',', $record);
            if ($subscriberData[0] === $subscriber[0]) {
                unset($subscriberRecords[$key]);
            }
        }

        file_put_contents($this->filePath, implode("\n", $subscriberRecords));
    }

    public function isSubscribing(int $id): bool
    {
        $this->createFileIfNotExist();

        return $this->findById($id) !== null;
    }

    public function getAllSubscribers(): array
    {
        $this->createFileIfNotExist();

        $handle = fopen($this->filePath, 'r');

        if ($handle === false) {
            throw new RuntimeException('Unable to read file');
        }

        $result = [];

        while (($row = fgetcsv($handle, 1000)) !== false) {
            $result[] = [
                'id' => $row[0],
                'value' => $row[1],
            ];
        }

        return $result;
    }

    private function findById(int $id): ?array
    {
        $handle = fopen($this->filePath, 'r');

        if ($handle === false) {
            throw new RuntimeException('Unable to read file');
        }

        while (($row = fgetcsv($handle, 1000, ",", '"', '\\')) !== false) {
            if ($id == $row[0]) {
                fclose($handle);
                return $row;
            }
        }

        return null;
    }

    private function createFileIfNotExist(): void
    {
        if (file_exists($this->filePath)) {
            return;
        }

        touch($this->filePath);
    }
}
