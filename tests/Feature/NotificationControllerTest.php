<?php

namespace Tests\Feature;

use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    public function test_can_send_notifications(): void
    {
        $response = $this->post('/notifications/send', ['content' => 'test notification']);

        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Notification send!!!');
    }

    public function test_error_if_content_empty(): void
    {
        $response = $this->post('/notifications/send', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'content' => 'The content field is required.'
        ]);
    }
}
