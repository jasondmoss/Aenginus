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

namespace Aenginus\Post;

use App\Post;

/**
 * PostHelper.
 *
 * @trait
 */
trait PostHelper
{

    /**
     * onPostShowing, clear this post's unread notifications.
     *
     * @param \App\Post $post
     *
     * @access public
     */
    public function onPostShowing(Post $post)
    {
        $user = auth()->user();
        if (!isAdmin($user)) {
            $post->increment('view_count');
        }

        if (auth()->check()) {
            $unreadNotifications = $user->unreadNotifications;
            foreach ($unreadNotifications as $notifications) {
                $comment = $notifications->data;
                if ($comment['commentable_type'] == 'App\Post' && $comment['commentable_id'] == $post->id) {
                    $notifications->markAsRead();
                }
            }
        }
    }
}

/* <> */
