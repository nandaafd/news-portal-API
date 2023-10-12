<?php

namespace App\Jobs;

use App\Events\CommentPosted;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Comment::create([
            'news_id'=>$this->data['news_id'],
            'user_id'=>$this->data['user_id'],
            'comment_text'=>$this->data['comment_text'],
        ]);
        event(new CommentPosted('Komentar Anda telah berhasil diposting.'));

    }
}
