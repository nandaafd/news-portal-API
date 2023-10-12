<?php

namespace App\Listeners;

use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use App\Models\NewsLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogNewsEvent
{

    public function __construct()
    {
        //
    }

    public function handle($event)
{
    $news = $event->news;

    $eventType = '';

    if ($event instanceof NewsCreated) {
        $eventType = 'created';
    } elseif ($event instanceof NewsUpdated) {
        $eventType = 'updated';
    } elseif ($event instanceof NewsDeleted) {
        $eventType = 'deleted';
    }

    NewsLog::create([
        'news_id' => $news->id,
        'event' => $eventType,
        'message' => 'Berita ' . $news->title . ' telah ' . $eventType . '.',
    ]);
}

}
