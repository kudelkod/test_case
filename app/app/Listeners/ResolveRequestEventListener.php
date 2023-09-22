<?php

namespace App\Listeners;

use App\Events\ResolveRequestEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ResolveRequestEventListener implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(ResolveRequestEvent $event): void
    {
        Mail::send('mail.mail', ['name' => $event->request->name, 'comment' => $event->request->comment], function($message) use($event) {
            $message->to($event->request->email)
                ->subject('Request resolved!');
        });
    }
}
