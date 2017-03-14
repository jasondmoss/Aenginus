<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use XblogConfig;
class BaseNotification extends Notification implements ShouldQueue
{
    public function enableMail()
    {
        return XblogConfig::getValue('enable_mail_notification') == 'true';
    }
}
