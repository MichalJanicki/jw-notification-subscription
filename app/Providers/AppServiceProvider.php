<?php

namespace App\Providers;

use App\Services\Person\PersonService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SubscriptionRepository;
use App\Repositories\PersonRepositoryInterface;
use App\Services\Person\PersonServiceInterface;
use App\Services\Notification\NotificationService;
use App\Services\Notification\SmsNotificationService;
use App\Repositories\Eloquent\EloquentPersonRepository;
use App\Repositories\Storage\CsvSubscriptionRepository;
use App\Services\Notification\EmailNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PersonRepositoryInterface::class, EloquentPersonRepository::class);
        $this->app->bind(PersonServiceInterface::class, PersonService::class);
        $this->app->bind(SubscriptionRepository::class, CsvSubscriptionRepository::class);
        $this->app->bind(NotificationService::class, function ($app) {
            $notificationService = new NotificationService();
            $notificationService->attach(new EmailNotificationService($app->make(SubscriptionRepository::class, ['filePath' => storage_path('app/private/email.csv')])));
            $notificationService->attach(new SmsNotificationService($app->make(SubscriptionRepository::class, ['filePath' => storage_path('app/private/sms.csv')])));
            return $notificationService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
