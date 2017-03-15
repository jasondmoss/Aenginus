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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Comment.
 *
 * @property mixed commentable_type
 * @property mixed commentable_id
 *
 * @uses \App\Ip
 * @uses \App\User
 */
class Comment extends Model
{

    use SoftDeletes;


    /**
     * ...
     *
     * @var array
     */
    protected $commentableData = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ 'deleted_at' ];

    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [ 'content' ];


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function ip()
    {
        return $this->belongsTo(Ip::class);
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * ...
     *
     * @return array
     * @access public
     */
    public function getCommentableData()
    {
        if (empty($this->commentableData)) {
            $this->commentableData['deleted'] = false;
            switch ($this->commentable_type) {
                case 'App\Post':
                    $post = app('App\Post')
                        ->where('id', $this->commentable_id)->select('title', 'slug')->first();
                    $this->commentableData['type'] = '文章';

                    if ($post == null) {
                        $this->commentableData['deleted'] = true;

                        return $this->commentableData;
                    }

                    $this->commentableData['title'] = $post->title;
                    $this->commentableData['url'] = route('post.show', $post->slug);
                    break;

                case 'App\Page':
                    $page = app('App\Page')
                        ->where('id', $this->commentable_id)->select('name', 'display_name')->first();
                    $this->commentableData['type'] = '页面';

                    if ($page == null) {
                        $this->commentableData['deleted'] = true;

                        return $this->commentableData;
                    }

                    $this->commentableData['title'] = $page->display_name;
                    $this->commentableData['url'] = route('page.show', $page->name);
                    break;
            }
        }

        return $this->commentableData;
    }
}

/* <> */
