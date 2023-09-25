<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Mail\ArticleCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendArticleCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\ArticleCreated $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $adminsMail = \App\Models\User::where('role', 'admin')->pluck('email')->toArray();
        Mail::to($adminsMail)->send(new ArticleCreatedMail($event->article));
    }
}
