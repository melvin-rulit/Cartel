<?php

namespace App\Listeners;

use App\Services\Smsc;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Log;

class UserRegisteredListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        // make sms code for user
        $event->user->sms_code = rand(1000, 9999);
        $event->user->save();

        // send sms
        $message = 'Your code: ' . $event->user->sms_code;
        $result = Smsc::sendSms($event->user->phone, $message);
        Log::info('Сообщение: ' . mb_convert_encoding($result, 'UTF-8'));
//        Log::info('SMS: ' . $result);

    }
}
