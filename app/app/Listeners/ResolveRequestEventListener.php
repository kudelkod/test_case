<?php

namespace App\Listeners;

use App\Events\ResolveRequestEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ResolveRequestEventListener implements ShouldQueue
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
    public function handle(ResolveRequestEvent $event): void
    {
        Mail::send('mail.mail', ['name' => '123'], function($message) use($event) {
            $message->to('123@t.t')
                ->subject('Request resolved!');
        });
    }
}
