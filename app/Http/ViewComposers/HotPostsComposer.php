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

namespace App\Http\ViewComposers;

use App\Facades\AenginusConfig;
use App\Http\Repositories\PostRepository;
use Illuminate\View\View;

/**
 * HotPostsComposer.
 *
 */
class HotPostsComposer
{

    /**
     * ...
     *
     * @var \App\Http\Repositories\PostRepository
     */
    protected $postRepository;


    /**
     * Create a new profile composer.
     *
     * @param \App\Http\Repositories\PostRepository $postRepository
     *
     * @internal param \App\Http\Repositories\UserRepository $users
     *
     * @access public
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @access public
     */
    public function compose(View $view)
    {
        $hotPosts = $this->postRepository
            ->hotPosts(AenginusConfig::getValue('hot_posts_count', 5))
            ->sortBy(function ($post, $key) {
                return -($post->view_count + $post->comments_count);
            });

        $view->with('hotPosts', $hotPosts);
    }
}

/* <> */
