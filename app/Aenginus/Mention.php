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

namespace Aenginus;

use App\Comment;
use App\Notifications\MentionedInComment;

class Mention
{
    public $content_original;
    public $content_parsed;

    public function replace()
    {
        $this->content_parsed = $this->content_original;
        foreach (getMentionedUsers($this->content_original) as $user) {
            $search = '@' . $user->name;
            $place = '[' . $search . '](' . route('user.show', $user->name) . ')';
            $this->content_parsed = str_replace($search, $place, $this->content_parsed);
        }
    }

    public function parse($content)
    {
        $this->content_original = $content;
        $this->replace();
        return $this->content_parsed;
    }

    public function mentionUsers(Comment $comment, $users, $raw_content)
    {
        foreach ($users as $user) {
            if (!isAdmin($users)) {
                $user->notify(new MentionedInComment($comment, $raw_content));
            }
        }
    }
}

/* <> */
