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

namespace App;

use Illuminate\Database\Eloquent\Model;
use Aenginus\Comment\CommentHelper;
use Aenginus\Config\ConfigureHelper;

class Page extends Model
{
    protected $fillable = ['name', 'display_name', 'content', 'html_content'];

    use CommentHelper, ConfigureHelper;

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function configuration()
    {
        return $this->morphOne(Configuration::class, 'configurable');
    }

    /**
     * @return array
     */
    public function getConfigKeys()
    {
        return ['allow_resource_comment', 'comment_type', 'comment_info', 'display', 'sort_order'];
    }
}

/* <> */
