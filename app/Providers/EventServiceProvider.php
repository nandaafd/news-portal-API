<?php

namespace App\Providers;

use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use App\Listeners\LogNewsEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */

    /**
     * Register any events for your application.
     */
    protected $listen = [
        Registered::class => [
                    SendEmailVerificationNotification::class,
                ],
        CommentPosted::class => [
            SendCommentPostedResponse::class,
        ],
        NewsCreated::class => [
            LogNewsEvent::class,
        ],
        NewsUpdated::class => [
            LogNewsEvent::class,
        ],
        NewsDeleted::class => [
            LogNewsEvent::class,
        ],
    ];
    
    public function boot(): void
    {
        
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
