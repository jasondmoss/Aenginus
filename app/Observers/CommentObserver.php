<?php

/**
 * Ænginus: Laravel Website Engine.
 *
 * @package    Laravel
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/aenginus/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/aenginus/
 */

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

/* <> */
