<?php

namespace App\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;

class CustomVerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;
    public function sendEmailVerificationNotification()
{
    $this->notify(new \App\Notifications\CustomVerifyEmailQueued);
}

}