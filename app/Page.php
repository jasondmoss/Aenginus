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

/**
 * Page.
 *
 * @uses \App\Comment
 * @uses \App\Configuration
 */
class Page extends Model
{

    use CommentHelper, ConfigureHelper;


    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [ 'name', 'display_name', 'content', 'html_content' ];


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function configuration()
    {
        return $this->morphOne(Configuration::class, 'configurable');
    }


    /**
     * ...
     *
     * @return array
     * @access public
     */
    public function getConfigKeys()
    {
        return [
            'allowResourceComment',
            'commentType',
            'comment_info',
            'display',
            'sort_order'
        ];
    }
}

/* <> */
