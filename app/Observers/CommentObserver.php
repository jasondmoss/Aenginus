<?php

namespace App\Observers;


use App\Comment;
use App\Notifications\ReceivedComment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        if (!isAdminById($comment->user_id)) {
            getAdminUser()->notify(new ReceivedComment($comment));
        }
    }
}
