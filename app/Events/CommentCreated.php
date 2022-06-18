<?php

namespace App\Events;

use App\Dtos\CommentDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     *
     * @param  \App\Dtos\CommentDTO  $comment
     * @return void
     */
    public function __construct(CommentDTO $comment)
    {
        $this->comment = $comment;
    }
}
