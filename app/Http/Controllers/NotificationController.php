<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationSendRequest;
use App\Services\Notification\NotificationService;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function __construct(private NotificationService $notificationService) {}

    public function __invoke(NotificationSendRequest $request): RedirectResponse
    {
        $content = $request->input('content');

        $this->notificationService->send($content);

        return redirect()->route('persons.index')->with('success', 'Notification send!!!');;
    }
}
